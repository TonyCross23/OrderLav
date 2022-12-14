
@extends('../user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" bg-dark text-white p-2 d-flex align-items-center justify-content-between mb-3">

                        <label class="my-2" for="price-all">Total Category List</label>
                        <span class="badge border font-weight-normal">{{count($category)}}</span>
                    </div>

                    <a href="{{ route('user#home') }}" class="text-dark">
                        <label class="" for="price-1">All</label>
                    </a>

                    @foreach ($category as $item)
                            <div class=" d-flex align-items-center justify-content-between mb-3">

                               <a href="{{ route('user#filter',$item->id) }}" class="text-dark">
                                  <label class="" for="price-1">{{ $item->name }}</label>
                               </a>

                            </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->

            <!-- Size Start -->
            <div class="mb-30">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


           <!-- Shop Product Start -->
      <div class="col-lg-9 col-md-8">
        <div class="row pb-3">
            <div class="col-12 pb-1">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                        <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                    </div>
                    <div class="ml-2">
                        <div class="btn-group">
                            <select name="sorting" id="sortingOption" class="form-control">
                                <option value="">chose Option</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                              </select>
                        </div>
                    </div>
                </div>
            </div>


                 <div class="d-flex" id="dataList">
                    @foreach ($product as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                       <div class="product-item bg-light mb-4 shadow-sm">
                           <div class="product-img position-relative overflow-hidden">
                               <img class="img-fluid w-100 " style="height: 210px;" src="{{ asset('storage/'.$item->image) }}" alt="">

                                   <div class="product-action">
                                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                       <a class="btn btn-outline-dark btn-square" href="{{ url('user/pizza/details/'.$item->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                   </div>
                           </div>
                           <div class="text-center py-4">
                               <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }}</a>
                               <div class="d-flex align-items-center justify-content-center mt-2">
                                   <h5>{{ $item->price }} kyats</h5>
                                   {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                               </div>
                               {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                   <small class="fa fa-star text-primary mr-1"></small>
                                   <small class="fa fa-star text-primary mr-1"></small>
                                   <small class="fa fa-star text-primary mr-1"></small>
                                   <small class="fa fa-star text-primary mr-1"></small>
                                   <small class="fa fa-star text-primary mr-1"></small>
                               </div> --}}
                           </div>
                       </div>
                   </div>
                 @endforeach
                 </div>


        </div>
    </div>
    <!-- Shop Product End -->

    </div>
</div>
<!-- Shop End -->

@endsection

@section('DocSource')
 <script>
    $(document).ready(function(){

        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();

            if($eventOption == 'asc') {
                $.ajax({
                    type : 'get' ,
                    url : 'http://127.0.0.1:8000/user/ajax/pizza/list' ,
                    data : {'status' : 'asc'} ,
                    dataType : 'json' ,
                    success : function(response){
                       $list = '' ;
                       for ($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="product-item bg-light mb-4 shadow-sm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " style="height: 210px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">

                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>

                                </div>

                            </div>
                        </div>
                        `;
                       }
                        $('#dataList').html($list);
                    }
                })
            }else if ($eventOption == 'desc'){
                    $.ajax({
                        type : 'get' ,
                        url : 'http://127.0.0.1:8000/user/ajax/pizza/list' ,
                        data : { 'status' : 'desc'},
                        dataType : 'json' ,
                        success : function(response){
                            $list = '' ;
                       for ($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="product-item bg-light mb-4 shadow-sm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " style="height: 210px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">

                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>

                                </div>

                            </div>
                        </div>
                        `;
                       }
                        $('#dataList').html($list);
                        }
                    })
            }
        })
    });
 </script>
@endsection
