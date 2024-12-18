@extends('layouts.member.master')

@section('title', 'Product List')

@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Explore our premium range of fresh and organic products curated just for you.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-lg border-0 h-100">
                            <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted mb-3">Rp.{{ number_format($product->price, 2) }}</p>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('member.cart.add', $product->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button class="btn btn-primary px-4"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                    </form>
                                    <a href="{{ route('member.products.show', $product->id) }}" class="btn btn-secondary px-4"><i class="fas fa-eye"></i> Show Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No products available at the moment. Please check back later!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- end product section -->
@endsection
