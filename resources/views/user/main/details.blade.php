@extends('user.layout.master')
@section('title','Product_detail')
@section('content')
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">

    <div class="offset-1 px-xl-5">
        <a href="{{route('user#home')}}">
            <button class="btn btn-dark"><i class="fa-solid fa-backward me-2"></i>Back</button>
        </a>
    </div>
    <div class="row px-xl-5 mt-1">
        <div class="col-5 offset-1 mb-30 mt-3">
            <div class="carousel-inner bg-light">
                <div class="carousel-item active">
                    <img class="w-100 h-80" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                </div>
            </div>
        </div>
        {{-- <input type="hidden" id="userId" value="{{Auth::user()->id}}"> --}}
        <div class="col-6 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$pizza->name}}</h3>
                <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                <input type="hidden" value="{{$pizza->id}}" id="pizzaId">
                {{-- <input type="hidden" name=""> --}}
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fa-solid fa-star text-dark"></small>
                        <small class="fa-solid fa-star text-dark"></small>
                        <small class="fa-solid fa-star text-dark"></small>
                        <small class="fa-solid fa-star-half text-dark"></small>
                        <small class="fa-regular fa-star text-dark"></small>
                    </div>
                    <small class="pt-1">{{$pizza->view_count}} <i class="fa-regular fa-eye"></i></small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}} Kyats</h3>
                <p class="mb-4">{{$pizza->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-dark text-warning btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-warning text-dark border-0 text-center" value="1" id="orderCount">
                        <div class="input-group-btn">
                            <button class="btn btn-dark text-warning btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="clickToCart" class="btn btn-dark text-warning px-3 mr-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <button type="button" id="clickToFav" class="btn btn-dark text-warning px-3"><i class="far fa-heart"></i></button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Shop Detail End -->

<!-- Products you may like Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($pizzaList as $pl)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset('storage/'.$pl->image)}}" alt="">
                        <div class="product-action">
                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> --}}
                            <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$pl->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$pl->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$pl->price}} Kyats</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-dark mr-1"></small>
                            <small class="fa fa-star text-dark mr-1"></small>
                            <small class="fa fa-star text-dark mr-1"></small>
                            <small class="fa fa-star text-dark mr-1"></small>
                            <small class="fa fa-star text-dark mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->
@endsection

{{-- Ajax scripts --}}
@section('scriptSource')

    <script>

        $(document).ready(function(){
            //increase view count

            // $pizzaId = { 'productId' : $('#pizzaId').val()};
            // console.log($pizzaId);

            $.ajax ({
                type : 'get' ,
                url : '/user/ajax/increase/view/count' ,
                data : {'productId' : $('#pizzaId').val()},
                dataType : 'json'
            })

            //click add to cart button
            $('#clickToCart').click(function(){
                // $count = $('#orderCount').val();
                if(typeof(''))
                $source = {
                    'count' : $('#orderCount').val(),
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val()
                };
                $.ajax ({
                    type : 'get' ,
                    url : '/user/ajax/list/cart' ,
                    data : $source ,
                    dataType : 'json' ,
                    success : function (response){
                        if(response.status == 'success'){
                            window.location.href = "/user/home";
                        }
                    }
                })

            })

            $('#clickToFav').click(function(){
                // $count = $('#orderCount').val();
                if(typeof(''))
                $source = {
                    'count' : $('#orderCount').val(),
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val()
                };
                // console.log($source);

                $.ajax ({
                    type : 'get' ,
                    url : '/user/ajax/add/to/fav' ,
                    data : $source ,
                    dataType : 'json' ,
                    success: function(response) {
                        if(response.status=='true')
                        window.location = "/user/ajax/view/fav";
                    },
                })

            })

        })
    </script>

@endsection
