@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $category->name }}</h1>
            @if($category->description)
                <p class="lead">{{ $category->description }}</p>
            @endif
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">
            No products found in this category.
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