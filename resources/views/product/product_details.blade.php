@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>
                <div class="card-body">
                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                <div class="product-card">
                                    <div class="product-title">
                                        <h5>{{ $product->name }}</h5>
                                    </div>
                                    <div class="product-details">
                                        <p class="text-muted mb-4">Price: ${{ number_format($product->cost, 2) }}</p>
                                        <div class="product-description">
                                            <strong>Description:</strong>
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                    @if(!auth()->user()->activeSubscription->count())
                                    <a href="{{ route('customer.product.purchase', [$product]) }}"
                                        class="btn btn-primary">Buy</a>
                                    @endif

                                    <a href="{{ route('customer.products.index')}}" class="btn btn-dark">back</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    }

    .product-title h5 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .product-details {
        margin-bottom: 20px;
    }

    .product-description p {
        font-size: 1rem;
    }

    .product-total {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 20px;
    }
</style>