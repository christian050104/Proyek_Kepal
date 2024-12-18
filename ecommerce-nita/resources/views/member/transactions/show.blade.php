@extends('layouts.member.master')

@section('title', 'Transaction Details')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-dark text-white text-center py-4">
            <h2 class="mb-0">Transaction Details</h2>
        </div>
        <div class="card-body p-5">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Transaction ID:</strong></p>
                    <p class="text-muted">{{ $transaction->id }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Total:</strong></p>
                    <p class="text-success fw-bold">Rp.{{ $transaction->total }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Address:</strong></p>
                    <p class="text-muted">{{ $address }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Phone:</strong></p>
                    <p class="text-muted">{{ $phone }}</p>
                </div>
            </div>

            <h3 class="mb-4 text-center">Products</h3>
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                            </td>
                            <td class="fw-bold">{{ $item['name'] }}</td>
                            <td>Rp.{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td class="text-success">Rp.{{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center bg-light py-4">
            <a href="{{ route('member.products.index') }}" class="btn btn-primary px-5">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection
