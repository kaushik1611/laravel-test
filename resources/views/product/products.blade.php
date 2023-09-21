@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>
                <div class="card-body">
                    @foreach ($products as $product)
                    <div class="product-card">
                        <h4>{{ $product->name }}</h4>
                        <p>Price: ${{ number_format($product->cost, 2) }}</p>
                        <a href="{{ route('customer.products.show', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .product-card {
        border: 1px solid #ddd;
        padding: 20px;
        text-align: center;
        background-color: #fff;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .product-card h4 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .product-card p {
        font-size: 1.25rem;
        margin-bottom: 10px;
    }

    /* Customize Bootstrap button styles */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff; /* Set text color to white */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
