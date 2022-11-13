@extends('admin.layouts.master')

@section('title','Products List')

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
                            <h2 class="title-1">Products List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
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
                        <form action="{{ route('product#list') }}" method="get">
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
                    <h4 class="text-muted"><i class="fa-solid fa-database mr-2"></i> {{ $pizzas->total() }} </h4>
                </div>
               </div>


                @if (count($pizzas) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pizzas as $item )
                                    <tr class="tr-shadow ">
                                        <td class="col-2"><img src="{{ asset('storage/'.$item->image) }}" class="img-thumbnail shadow-sm"></td>
                                        <td class="col-2">{{ $item->name }}</td>
                                        <td class="col-2">{{ $item->price }}</td>
                                        <td class="col-2">{{ $item->category_name }}</td>
                                        <td class="col-2"><i class="fa-solid fa-eye me-2"></i>{{ $item->view_count }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('product#edit',$item->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#updatePage',$item->id) }}" class="mr-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square text-info"></i>
                                                    </button>
                                                </a>
                                            <a href="{{ route('product#delete',$item->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </button>
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach

                        </tbody>
                    </table>
                     <div class="mt-3">
                        {{-- {{ $categories->links() }} --}}
                        {{ $pizzas->appends(request()->query())->links() }}
                     </div>
                </div>
                @else
                     <h4 class="text-secondary text-center mt-5">There is no Pizza Here!</h4>
                @endif


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
