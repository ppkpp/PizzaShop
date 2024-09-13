@extends('user.layout.master')
@section('title','PizzaLand')
@section('content')

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h4 class="position-relative text-uppercase mb-3"><span class=" text-secondary pr-3">Filter by category</span></h4>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                        <label class="" for="price-all"><h5>Categories</h5></label>
                        {{-- <span class="badge border text-dark font-weight-normal">{{ count($category )}}</span> --}}
                    </div>
                    <hr>
                    <div class="form-check my-4">
                        <a href="{{route('user#home')}}">
                            <label class="form-check-label text-dark" for="defaultCheck1">
                                All
                            </label>
                        </a>
                    </div>
                    @foreach ($category as $c )
                        <div class="form-check my-4">
                            {{-- <input class="form-check-input text-warning" type="checkbox" value="" id="defaultCheck1"> --}}
                            <a href="{{route('user#filter',$c->id)}}">
                                <label class="form-check-label text-dark" for="defaultCheck1">
                                    {{$c->name}}
                                </label>
                            </a>
                            {{-- <a href="{{route('user#filter',$c->id)}}">
                                {{$c->name}}
                            </a> --}}
                        </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->

            <div class="">
                <a href="{{route('cart#list#page')}}">
                    <button class="btn btn btn-warning w-100">Order</button>
                </a>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="col-5">
                            <a href="{{route('view#FavPage')}}" class="btn px-0 ml-4">
                                <h4>
                                    <i class="fas fa-heart font-large text-dark"></i>
                                    <span class="badge text-dark border border-secondary rounded-circle " style="padding-bottom: 7px;">{{$fav_count}}</span>
                                </h4>
                            </a>
                            <a href="{{route('cart#list#page')}}" class="btn px-0 ml-3">
                                <h4>
                                    <i class="fas fa-shopping-cart text-dark"></i>
                                    <span class="badge text-dark border border-secondary rounded-circle" id='quantity' style="padding-bottom: 7px;">{{$quantity}}</span>
                                </h4>
                            </a>
                            <a href="{{route('order#History')}}" class="btn px-0 ml-3">
                                <h4>
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span class="badge text-dark border border-secondary rounded-circle" id='quantity' style="padding-bottom: 7px;">{{count($order)}}</span>
                                </h4>
                            </a>
                        </div>
                        <div class="px-5">
                            <form action="{{route('user#home')}}" class="form-coontrol input-lg">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name='key' class="text-muted" placeholder="Searching for..." value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-dark text-white">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="ml-2 ">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (count($pizza)!=0)
                <div class="row" id='myLists'>
                    @foreach ($pizza as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id='myForm'>
                            <div class="product-img position-relative overflow-hidden" style="height: 150px">
                                <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="">
                                <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                                <input type="hidden" class="pizzaId" value="{{$p->id}}">
                                <div class="product-action">
                                    {{-- <input type="hidden" class="userId" value="{{Auth::user()->id}}"> --}}
                                    {{-- <input type="hidden" class="pizzaId" value="{{$p->id}}"> --}}
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
                                    {{-- <button type="button" id="clickToCart" class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button> --}}
                                    {{-- <a class="btn btn-outline-dark btn-square" id="clickToFav" ><i class="far fa-heart"></i></a> --}}
                                    <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$p->price}} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="mt-5">
                    <h3 class="text-center">There is no product here.</h3>
                </div>
                @endif

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('#sortingOption').change(function(){
                $eventSorting = $('#sortingOption').val();

                if($eventSorting=='asc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza/list' ,
                        data : {'status' : 'asc'},
                        dataType : 'json',
                        success : function (response){
                            // $list = response.length;
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id='myForm'>
                                        <div class="product-img position-relative overflow-hidden" style="height: 150px">
                                            <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}</h5>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#myLists').html($list);
                        }

                    })
                }else if ($eventSorting=='desc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza/list' ,
                        data : {'status' : 'desc'},
                        dataType : 'json',
                        success : function (response){
                            $list = response.length;
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id='myForm'>
                                        <div class="product-img position-relative overflow-hidden" style="height: 150px">
                                            <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#myLists').html($list);
                            // logger(response);
                        }

                    })
                }
            })
        })
    </script>

{{-- <script>

        $(document).ready(function(){
            $('#clickToFav').click(function(){

                if(typeof(''))
                $source = {
                    'userId' : $('.userId').val(),
                    'pizzaId' : $('.pizzaId').val()
                };
                // console.log($source);

                $.ajax ({
                    type : 'get' ,
                    url : 'http://127.0.0.1:8000/user/ajax/add/to/fav' ,
                    data : $source ,
                    dataType : 'json' ,
                    success: function(response) {
                        if(response.status=='true')
                        window.location = "http://127.0.0.1:8000/user/ajax/view/fav";
                    },
                })
            })
        })

</script> --}}
@endsection


