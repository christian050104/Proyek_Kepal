@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <h5>Welcome to the Admin Dashboard!</h5>
                    <p>Manage your application here.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
