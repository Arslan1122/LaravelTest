@extends('layouts.dashboard.master')
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                            All Users
                    </h4>
                    <p class="card-description"></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>card type</th>
                                <th>Last 4 digits</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td> {{ @$user->pm_type }}</td>
                                    <td> {{ @$user->user->pm_last_four }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td><label class="badge badge-danger">@if($user->status) Active @else InActive @endif</label></td>
                                        <td>
                                            <a href="{{ route('users.inactive', $user->id) }}" class="btn btn-sm btn-danger">Inactive User</a>
                                        </td>
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