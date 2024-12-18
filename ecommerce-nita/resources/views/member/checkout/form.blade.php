@extends('layouts.member.master')

@section('title', 'Checkout')

@section('content')
<div class="container mt-5">
    <h1>Checkout</h1>

    @if (session('cart') && count(session('cart')) > 0)
    <form action="{{ route('member.checkout.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" rows="3" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
    
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
