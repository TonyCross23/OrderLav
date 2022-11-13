@extends('admin.layouts.master')

@section('title','Change Password')

@section('content')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">

                        @if (session('notMatch'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('notMatch') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Current Password</label>
                                <input type="hidden"   >
                                <input id="cc-pament" name="oldPassword"  type="password"  class="form-control @error('oldPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Your Current Password">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror



                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">New Password</label>
                                <input type="hidden"   >
                                <input id="cc-pament" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid
                                @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Your New Password">
                                 @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Re-type New Password</label>
                                <input type="hidden"  >
                                <input id="cc-pament" name="re-newPassword" type="password"  class="form-control   @error('re-newPassword') is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Re-type New Password" >
                                @error('re-newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
