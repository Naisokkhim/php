<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add products before checkout.');
        }
        
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add products before checkout.');
        }
        
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'nullable|string',
            'phone_number' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'] ?? $validated['shipping_address'],
            'phone_number' => $validated['phone_number'],
            'notes' => $validated['notes'],
        ]);
        
        // Create order items
        foreach ($cartItems as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        
        // Clear cart
        session()->forget('cart');
        
        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Only allow editing of pending orders
        if ($order->status !== 'pending' || $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Only allow updating of pending orders
        if ($order->status !== 'pending' || $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'nullable|string',
            'phone_number' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        $order->update([
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'] ?? $validated['shipping_address'],
            'phone_number' => $validated['phone_number'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('orders.show', $order)
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Cancel an order.
     */
    public function cancel(Order $order)
    {
        // Only allow cancellation of pending orders
        if ($order->status !== 'pending' || $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('orders.index')
            ->with('success', 'Order cancelled successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Prevent deletion of orders - only allow cancellation
        abort(403, 'Orders cannot be deleted. Please use cancel instead.');
    }
}
