@extends('admin.layouts.master')

@section('title','Edit admin Account')

@section('content')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Admin Account Role</h3>
                        </div>
                        <hr>

                            <form action="{{ route('admin#roleUpdate',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                            <img src="{{asset('image/user_profile.jpg')}}" class="img-thumbnail" alt="">
                                            @else
                                            <img src="{{asset('image/female_profile.jpg')}}" class="img-thumbnail" alt="">
                                            @endif
                                        @else
                                             <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail"  />
                                        @endif


                                        <div class="mt-4">
                                            <button class="btn btn-dark text-white col-10" type="submit">
                                                Update
                                            </button>
                                        </div>

                                    </div>
                                    <div class=" row col-4 ">
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Name</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" disabled name="name" type="type" value="{{ old('name',$account->name) }}" class="form-control @error('name') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admn @if ($account->gender == 'admin') selected  @endif ">Admin</option>
                                                <option value="user @if ($account->gender == 'user') selected  @endif">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">email</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" disabled name="email" type="email" value="{{ old('email',$account->email) }}" class="form-control @error('email') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input type="hidden"   >
                                            <input id="cc-pament" disabled name="phone" type="number" value="{{ old('phone',$account->phone) }}" class="form-control @error('phone') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <input type="hidden"   >
                                            <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
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
                                            <input name="address" disabled value="{{ old('address',Auth::user()->address) }}" class="form-control @error('address') is-invalid @enderror" cols="10" rows="5">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
