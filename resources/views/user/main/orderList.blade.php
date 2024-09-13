@extends('user.layout.master')
@section('title','Cart_Page')
@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <th></th>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartlist as $c)
                    <tr>
                        {{-- <input type="hidden" name="" value="{{$c->price}}" id="price"> --}}

                        <td><img src="{{asset('storage/'.$c->product_image)}}" class="img-thumbnail shadow-sm" alt="" style="width: 100px;"></td>
                        <td class="align-middle">{{$c->pizza_name}}
                            <input type="hidden" class="userId" value="{{$c->user_id}}">
                            <input type="hidden" class="productId" value="{{$c->product_id}}">
                            <input type="hidden" value="{{$total}}" class="total">
                        </td>
                        <td class="align-middle" id="pizzaPrice">{{$c->price}} Kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-dark btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="qty" class="form-control form-control-sm bg-warning border-0 text-center" value="{{$c->quantity}}" min="0" max="20">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-dark btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{$c->price * $c->quantity}} Kyats</td>
                        <td class="align-middle" ><button class="btn btn-sm btn-danger btn-remove" id="remove"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


@section('scriptSource')

    </script>
@endsection

