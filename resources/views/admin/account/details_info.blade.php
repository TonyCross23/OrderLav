@extends('admin.layouts.master')

@section('title','Account Info')

@section('content')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="row">
        <div class="col-3 offset-7 ">
            @if (session('updateSuccess'))
            <div>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-sharp fa-solid fa-trash"></i> {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                       <img src="{{asset('image/user_profile.jpg')}}" class="img-thumbnail" alt="">
                                    @else
                                       <img src="{{asset('image/female_profile.jpg')}}" class="img-thumbnail" alt="">
                                    @endif
                                 @else
                                   <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail"  />
                               @endif
                            </div>
                            <div class="col-4 offset-1 ">
                                <h4 class="text-muted mb-3"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                <h4 class="text-muted mb-3"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                <h4 class="text-muted mb-3"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                <h4 class="text-muted mb-3"><i class="fa-solid fa-mars-and-venus"></i>{{ Auth::user()->gender }}</h4>
                                <h4 class="text-muted mb-3"><i class="fa-solid fa-location-dot me-2"></i>{{ Auth::user()->address }}</h4>
                                <h4 class="text-muted mb-3"><i class="fa-regular fa-calendar-days me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 offset-2">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
