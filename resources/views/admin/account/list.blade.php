@extends('admin.layouts.master')

@section('title','Admin List')

@section('content')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin Account List</h2>
                        </div>
                    </div>
                    {{-- <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div> --}}
                </div>

                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

               <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-success">{{ request('key') }}</span> </h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('admin#list') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="search" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button class="btn btn-success text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
               </div>

               <div class="row mt-2 ">
                <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                    <h4 class="text-muted"><i class="fa-solid fa-database mr-2"></i> {{ $admin->total() }} </h4>
                </div>
               </div>



                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admin as $item )
                                    <tr class="tr-shadow ">
                                        <td class="col-1">
                                            @if ($item->image == null)
                                                @if ($item->gender == 'male')
                                                   <img src="{{asset('image/user_profile.jpg')}}" class="img-thumbnail" alt="">
                                                @else
                                                    <img src="{{asset('image/female_profile.jpg')}}" class="img-thumbnail" alt="">
                                                @endif
                                            @else
                                                 <img src="{{ asset('storage/'.$item->image) }}" class="img-thumbnail">
                                            @endif
                                        </td>
                                        <td class="">{{ $item->name }}</td>
                                        <td class="">{{ $item->email }}</td>
                                        <td class="">{{ $item->gender }}</td>
                                        <td class="">{{ $item->phone }}</td>
                                        <td class="">{{ $item->address }}</td>
                                        <td>
                                            <div class="table-data-feature">

                                             @if (Auth::user()->id == $item->id)

                                                 @else

                                                 <a href="{{ route('admin#role',$item->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Admin Account Change">
                                                        <i class="fa-solid fa-person-circle-minus text-info"></i>
                                                    </button>

                                                 <a href="{{ route('admin#delete',$item->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                            </a>
                                             @endif

                                        </td>
                                    </tr>
                            @endforeach

                        </tbody>
                    </table>
                     <div class="mt-3">
                        {{-- {{ $categories->links() }} --}}
                        {{ $admin->appends(request()->query())->links() }}
                     </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
