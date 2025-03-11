@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-image fa-4x text-secondary"></i>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Category: <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></p>
            <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>
            
            <div class="my-4">
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>
            
            <div class="d-flex align-items-center mb-4">
                <span class="me-3">Availability:</span>
                @if($product->stock > 0)
                    <span class="badge bg-success">In Stock ({{ $product->stock }} available)</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>
            
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-primary btn-lg" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg ms-2">Continue Shopping</a>
                </div>
            </form>
            
            @auth
                @if(auth()->user()->is_admin)
                <div class="mt-4 pt-4 border-top">
                    <h5>Admin Actions</h5>
                    <div class="d-flex">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Edit Product
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Product
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection