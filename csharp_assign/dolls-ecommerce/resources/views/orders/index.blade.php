@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>My Orders</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-shopping-cart"></i> Continue Shopping
            </a>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            You haven't placed any orders yet. <a href="{{ route('products.index') }}">Browse products</a> to start shopping.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="align-middle">#{{ $order->id }}</td>
                                    <td class="align-middle">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="align-middle">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="align-middle">
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge bg-info">Processing</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        @if($order->status == 'pending')
                                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning ms-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('orders.cancel', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger ms-1">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection