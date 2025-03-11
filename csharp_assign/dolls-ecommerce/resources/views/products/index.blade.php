@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Products</h1>
        </div>
        <div class="col-md-4 text-end">
            @auth
                @if(auth()->user()->is_admin)
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Min price" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Max price" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">
            No products found. Please try a different search or filter.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                        @else
                            <div class="card-img-top product-img bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                            <p class="card-text"><small class="text-muted">{{ $product->category->name }}</small></p>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection