@extends('layouts.member.master')

@section('title', 'Your Cart')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white text-center py-4">
            <h2 class="mb-0">Your Cart</h2>
        </div>
        <div class="card-body">
            @if (session('cart') && count(session('cart')) > 0)
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $details)
                            <tr>
                                <td>
                                    <img src="{{ asset($details['image'] ?? 'default-image.jpg') }}" 
                                         alt="{{ $details['name'] }}" 
                                         class="img-thumbnail" 
                                         style="width: 80px; height: 80px;">
                                </td>
                                <td class="fw-bold">{{ $details['name'] }}</td>
                                <td>${{ number_format($details['price'], 2) }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td class="text-success">Rp.{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('member.cart.decrement', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('member.cart.add', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('member.cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('member.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                    <a href="{{ route('member.checkout.form') }}" class="btn btn-primary px-5">
                        Proceed to Checkout <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-5">
                    <h3 class="text-muted">Your cart is empty!</h3>
                    <a href="{{ route('member.products.index') }}" class="btn btn-primary mt-4">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
        <div class="card-footer bg-light text-center py-3">
            <p class="mb-0 text-muted">Thank you for shopping with us!</p>
        </div>
    </div>
</div>
@endsection
