@extends('user.layout.master')
@section('title','Favorite_Page')
@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <a href="{{route('user#home')}}" class="">
            <button class="btn btn-dark"><i class="fa-solid fa-backward me-2"></i>Back</button>
        </a>
        <div class="col-lg-8 table-responsive mt-3 mb-5" >
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    {{-- <th></th> --}}
                    <th>Menu</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Remove</th>
                </thead>
                <tbody class="align-middle" >
                    @foreach ($fav as $f)
                        <tr>
                            <td class="col-2"><img src="{{asset('storage/'.$f->product_image)}}" class="img-thumbnail shadow-sm" alt="" style="width: 100px;"></td>
                            <td class="col-2 align-middle">
                                <a href="{{route('product#detail',$f->p_id)}}">{{$f->pizza_name}}</a> </td>
                            <td class="col-5 align-middle">{{$f->description}}</td>
                            <td class="col-2 align-middle" id="pizzaPrice">{{$f->product_price}} Kyats</td>
                            <td class="col-1 align-middle text-center" id="delete">
                                <input type="hidden" name="" value="{{$f->product_id}}" class="productId">
                                <input type="hidden" name="" value="{{$f->id}}" class="favId">
                                <input type="hidden" name="" value="{{$f->user_id}}" class="userId">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn" >
                                        <button class="btn btn-sm btn-danger btn-minus" >
                                            <i class="fa-solid fa-square-minus font-large"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-warning px-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">

                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotal">{{$total}} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium" id="delivery">{{$delivery}} Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalTotal">{{$total + $delivery}} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-dark font-weight-bold my-3 py-3 text-white mt-5" id="orderBtn">Proceed To Checkout</button>
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 text-white " id="clearBtn">Clear Cart</button>
                </div>
            </div>
        </div> --}}
        {{-- pagination --}}
        <div class="">
            {{$fav->links()}}
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function(){
        //remove whole cart list
            $('#delete').click(function(){
                $parentNode = $(this).parents("tr");
                $productId = $parentNode.find(".productId").val();
                $userId = $parentNode.find(".userId").val();
                $favId = $parentNode.find(".favId").val();
                console.log($productId);

                $.ajax({
                    type:'get',
                    url : "/user/ajax/clear/fav",
                    data : {
                        'favId' : $favId ,
                        'productId' : $productId,
                        'userId' : $userId},
                    dataType : "json",
                    success: function(response) {
                        if(response.status=='true')
                        window.location = "/user/ajax/view/fav";
                    },
                });
            })
        });
    </script>

@endsection

