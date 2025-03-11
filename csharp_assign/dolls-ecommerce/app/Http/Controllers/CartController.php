<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        $products = [];
        
        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $products[$id] = $product;
                $total += $details['price'] * $details['quantity'];
            }
        }
        
        return view('cart.index', compact('cartItems', 'total', 'products'));
    }
    
    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    /**
     * Update the cart item quantity.
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    
    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    
    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
