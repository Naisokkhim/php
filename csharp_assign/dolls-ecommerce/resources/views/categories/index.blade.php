@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Product Categories</h1>
        </div>
        <div class="col-md-4 text-end">
            @auth
                @if(auth()->user()->is_admin)
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Category
                </a>
                @endif
            @endauth
        </div>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-info">
            No categories found.
        </div>
    @else
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ $category->products_count }} products</small></p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-primary">View Products</a>
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <div>
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection