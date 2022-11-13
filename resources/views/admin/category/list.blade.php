@extends('admin.layouts.master')

@section('title','Category List')

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
                            <h2 class="title-1">Category List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                @if (session('categorySuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('categorySuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('deleteCategory'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-sharp fa-solid fa-trash"></i> {{ session('deleteCategory') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('categoryUpdate'))
                <div class="col-4 offset-8">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                       <i class="fa-solid fa-check"></i> {{ session('categoryUpdate') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

               <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-success">{{ request('key') }}</span> </h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('category#list') }}" method="get">
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
                    <h4 class="text-muted"><i class="fa-solid fa-database mr-2"></i> {{ $categories->total() }}</h4>
                </div>
               </div>

                @if (count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr class="tr-shadow ">
                                    <td>{{ $category->id }}</td>
                                    <td class="col-6">{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button> --}}
                                            <a href="{{ route('category#edit',$category->id) }}" class="mr-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square text-info"></i>
                                                </button>
                                            </a>
                                           <a href="{{ route('category#delete',$category->id) }}">
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
                        {{ $categories->appends(request()->query())->links() }}
                     </div>
                </div>
                @else
                     <h4 class="text-secondary text-center mt-5">There is no Category Here!</h4>
                @endif

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
