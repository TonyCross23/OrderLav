
@extends('../user.layouts.master')

@section('content')
      <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-9 offset-2">
                <div class="card">
                    <div class="ms-4 my-3">
                        <a href="{{ route('user#home') }}">
                            <i class="fa-solid fa-arrow-left text-dark"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Account Info</h3>
                        </div>
                        <hr>

                            <form action="{{ route('user#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                            <img src="{{asset('image/user_profile.jpg')}}" class="img-thumbnail" alt="">
                                            @else
                                            <img src="{{asset('image/female_profile.jpg')}}" class="img-thumbnail" alt="">
                                            @endif
                                        @else
                                             <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail"  />
                                        @endif

                                        <div class="mt-4">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-dark text-white col-12" type="submit">
                                                Update
                                            </button>
                                        </div>

                                    </div>
                                    <div class=" row col-6 ">
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Name</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" name="name" type="type" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">email</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" name="phone" type="number" value="{{ old('phone',Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <input type="hidden"   >
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choser Gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Address</label>
                                            <input type="hidden"   >
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="10" rows="5">{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Role</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" name="role" type="type" value="{{ old('role',Auth::user()->role) }}" class="form-control   aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                    </div>
                                </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
