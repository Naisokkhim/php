@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Shopping Cart</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>
    </div>

    @if(empty($cartItems))
        <div class="alert alert-info">
            Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a> to add items to your cart.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $id => $details)
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            @if(isset($products[$id]) && $products[$id]->image)
                                                <img src="{{ asset('storage/' . $products[$id]->image) }}" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-secondary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $details['name'] }}</h6>
                                                @if(isset($products[$id]))
                                                    <small class="text-muted">{{ $products[$id]->category->name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">${{ number_format($details['price'], 2) }}</td>
                                    <td class="align-middle" style="width: 150px;">
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">${{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to clear your cart?');">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </form>
                    <div>
                        @auth
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag"></i> Proceed to Checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login to Checkout
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection