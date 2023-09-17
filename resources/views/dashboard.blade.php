@extends('layouts.dashboard.master')
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @if($role == \App\Models\User::B2B_ROLE)
                            <span class="badge badge-success">B2B USER</span>
                        @elseif($role == \App\Models\User::B2C_ROLE)
                            <span class="badge badge-success">B2C USER</span>
                        @else
                            All Orders
                        @endif
                    </h4>
                    <p class="card-description"></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>card type</th>
                                <th>Last 4 digits</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->product->name }}</td>
                                <td>$ {{ $order->product->price }}</td>
                                <td> {{ $order->user->pm_type }}</td>
                                <td> {{ $order->user->pm_last_four }}</td>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td><label class="badge badge-danger">{{ $order->status }}</label></td>
                                @if($order->status != "refunded")
                                <td>
                                    <a href="{{ route('cancel.order', $order->id) }}" class="btn btn-sm btn-danger">cancel order</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection