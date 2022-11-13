@extends('admin.layouts.master')

@section('title','Pizza Detail')

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
                        <div class="">
                            <button class="btn" onclick="history.back()";><i class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">

                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" />

                            </div>
                            <div class="col-7 ">
                                <h3 class="mb-3">{{ $pizza->name }}</h3>
                                <h4 class="mb-3 btn bg-dark text-white"><i class="fa-solid fa-money-bill me-2"></i>{{ $pizza->price }} Kyat</h4>
                                <h4 class="mb-3 btn bg-dark text-white"><i class="fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }} mins</h4>
                                <h4 class="mb-3 btn bg-dark text-white"><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</h4>
                                <h4 class="mb-3 btn bg-dark text-white"><i class="fa-solid fa-layer-group me-2"></i>{{ $pizza->category_name }}</h4>
                                <h4 class="mb-3 btn bg-dark text-white"><i class="fa-regular fa-calendar-days me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</h4>
                                <h4 class="mb-2"><i class="fa-solid fa-file me-2"></i>Desctiption</h4>
                                <h5 class="text-muted">{{$pizza->description }}</h5>

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
