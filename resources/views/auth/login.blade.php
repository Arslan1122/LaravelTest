@extends('layouts.app')
@section('content')
    <!-- Session Status -->
    <div class="container mt-5">
        <div class="row" id="signin-box">
            <div class="col-md-6 mb-5 offset-md-3">
                <h2 class="h3 mb-3 text-black">Login Credentials</h2>
                @if(\Session::has('error'))
                    <span class="text-danger">{{ \Session::get('error') }}</span>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @error('status')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection