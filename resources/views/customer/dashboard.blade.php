@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>Hi there, {{ auth()->user()->name }}</p>

                    <a href="{{ route('customer.products.index') }}" class="btn btn-primary btn-sm">View Products</a>
                    <div class="card mt-4">
                        <div class="card-body">
                            @if (auth()->user()->hasRole('b2cCustomer'))
                            <h6>B2C Purchase</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Card Type: {{ auth()->user()->pm_type }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Last 4 Digits: {{ auth()->user()->pm_last_four }}</p>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('subscription.destroy') }}" class="btn btn-danger mt-2">cancel</a>
                                </div>
                            </div>
                            @elseif(auth()->user()->hasRole('b2bCustomer'))
                            <h6>B2B Purchase</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Card Type: {{ ucwords(auth()->user()->pm_type) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p> **** **** **** {{ auth()->user()->pm_last_four }}</p>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('subscription.destroy') }}" class="btn btn-danger mt-2">Cancel</a>
                                </div>
                            </div>
                            @else
                            <p>No purchase details available.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection