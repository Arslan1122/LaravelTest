@extends('layouts.app')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <form method="post"  action="{{ route('checkout') }}">
            @csrf
        <div class="container">

            <div class="row d-none" id="signin-box">
                <h2 class="h3 mb-3 text-black">Add login credentials</h2>
                <div class="p-3 p-lg-5 border bg-white">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_fname" class="text-black">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullName" name="full_name">
                                @error('full_name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="address" placeholder="Street address">
                                @error('address')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                            @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <select id="c_country" name="country" class="form-control">
                                <option value="">Select a country</option>
                                <option value="USA">United State of Americe</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Albania">Albania</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="state" name="state">
                                @error('state')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="postal">
                                @error('postal')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if(!Auth::check())
                        <div class="form-group row mb-5 mt-2" id="new_email_address">
                            <div class="col-md-12">
                                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_email_address" name="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Add Card Details</h2>
                                <div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="stripeToken" id="stripeToken">

                                    <div class="p-3 p-lg-5 border bg-white">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element" class="mt-2">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" class="text-danger" role="alert"></div>
                                </div>
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    </div>
@endsection

@section('scripts')


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Set the token in the hidden input field
                    document.getElementById('stripeToken').value = result.token.id;
                    // Now, submit the form
                    form.submit();
                }
            });
        });
    </script>

@endsection