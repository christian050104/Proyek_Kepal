@extends('layouts.member.master')

@section('title', $product->name)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>
@endsection
