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
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Email</th>
                                <th scope="col">PM Type</th>
                                <th scope="col">PM Last Four</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $key=>$customer)
                              <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $customer->name}}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->pm_type ?? 'N/A'}} </td>
                                <td>{{ $customer->pm_last_four ?? 'N/A'}}</td>
                                <td>
                                    @if($customer->activeSubscription->count())
                                    <a href="{{ route('admin.subscription.cancel',[$customer]) }}" class="btn btn-danger btn-sm mt-2">Cancel</a>
                                    @endif                                
                                </td>                                
                              </tr>
                              @empty
                              @endforelse
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
