@extends('user.layout.master')
@section('title','Cart_Page')
@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <a href="{{route('user#home')}}" class="">
            <button class="btn btn-dark"><i class="fa-solid fa-backward me-2"></i>Back</button>
        </a>
        <div class="col-lg-8 table-responsive mt-3 mb-5">
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
                            <td><img src="{{asset('storage/'.$c->product_image)}}" class="img-thumbnail shadow-sm" alt="" style="width: 100px;"></td>
                            <td class="align-middle">{{$c->pizza_name}}
                                <input type="hidden" class="userId" value="{{$c->user_id}}">
                                <input type="hidden" class="eachId" value="{{$c->id}}">
                                <input type="hidden" id="eachPrice" value="{{$c->price}}">
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

                            <td class="align-middle" id="total" >{{$c->price * $c->quantity}} Kyats</td>
                            <input type="hidden" value="{{$c->price * $c->quantity}}"  id="totalprice" >
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
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 text-white " id="clearBtn">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(event){
                $parent = $(this).parents("tr");
                $price = Number($parent.find('#pizzaPrice').text().replace(" Kyats",""));
                $qty = Number($parent.find("#qty").val());
                $newtotal = $price * $qty;
                $parent.find('#total').html($newtotal+' Kyats');
                summaryCalculation();
                deliveryFee();
            })

            $('.btn-minus').click(function(){
                $parent = $(this).parents("tr");
                $price = Number($parent.find('#pizzaPrice').text().replace(" Kyats",""));
                $qty = Number($parent.find("#qty").val());
                $newtotal = $price * $qty;
                $parent.find('#total').html($newtotal+' Kyats');
                summaryCalculation();
                deliveryFee();
            })

            $('.btn-remove').click(function(){
                $parent = $(this).parents("tr");
                $parent.remove();
                summaryCalculation();
                deliveryFee();
                $('#finalTotal').html($finalTotal+" Kyats");
            })

            //remove each product
            $('#remove').click(function(){
                $parentNode = $(this).parents("tr");
                $productId = $parentNode.find(".productId").val();
                $orderId = $parentNode.find(".eachId").val();
                $.ajax({
                    type:'get',
                    url : "/user/ajax/clear/each/product",
                    data : {'productId' : $productId , 'orderId' : $orderId},
                    dataType : "json",
                });
                summaryCalculation();
                deliveryFee();
            })

            function summaryCalculation(){
                $newSubTotal = 0;
                $("#dataTable tbody tr").each(function(index,row){
                    $newSubTotal += Number($(row).find('#total').text().replace(" Kyats",""));
                })
                $('#subTotal').html($newSubTotal+" Kyats");
            }

            function deliveryFee(){
                $finalTotal = $newSubTotal;
                if($newSubTotal<100000){
                    $finalTotal = $finalTotal + 2500;
                    $('#delivery').html('2500 Kyats');
                }else{
                    $finalTotal = $finalTotal + 0;
                    $('#delivery').html('0 Kyats');
                }
                $('#finalTotal').html($finalTotal+" Kyats");
            }
        })
    </script>

    <script>
        $(document).ready(function(){
            $("#orderBtn").click(function(){
                // $parent = $(this).parents(".container-fluid");
                // $overallQty = ($parent.find('#qty').val())*1;
                // $eachPrice = ($parent.find('#eachPrice').val())*1;
                // $overallPrice = $overallQty * $eachPrice;
                // $price = $parent.find('#total').val();
                // $price =
                $orderList = [];
                $preCode = Math.floor(Math.random() * 1000001) + 1;
                $('#dataTable tbody tr').each(function(index,row){
                     $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find(".productId").val(),
                        'quantity' : $(row).find('#qty').val(),
                        // 'total_price' : Number($(row).find('#total').val()),
                        'total_price' :  (($(row).find('#qty').val())*1) *(($(row).find('#eachPrice').val())*1) ,
                        'code' : 'PZL' + $preCode
                    });
                });

                // console.log($orderList);

                $.ajax({
                    type: "get",
                    url: "/user/ajax/checkout",
                    data: Object.assign({}, $orderList),
                    dataType: "json",
                    success: function(response) {
                        if(response.status=='true')
                        window.location = "/user/home";
                    }

                });
            });
        })
    </script>

    {{-- <script>
        $(document).ready(function(){
            $("#orderBtn").click(function(){
                $parent = $(this).parents("tr");
                $overallQty = Number($parent.find('#qty').val());
                $eachPrice = Number($parent.find('#pizzaPrice').val());
                $overallPrice = $overallQty * $eachPrice;
                // $orderList = [];
                // $preCode = Math.floor(Math.random() * 1000001) + 1;
                // // $overallQty = Number($(row).find('#qty').val());
                // // $eachPrice = Number($(row).find('#eachPrice').val());
                // // $overallPrice = $overallQty * $eachPrice;
                // $('#dataTable tbody tr').each(function(index,row){

                //     $orderList.push({
                //         'user_id' : $(row).find('.userId').val(),
                //         'product_id' : $(row).find(".productId").val(),
                //         'quantity' : $(row).find('#qty').val(),
                //         'total_price' :$overallPrice,
                //         // 'total_price' : Number($(row).find('#totalprice').val()),
                //         'code' : 'PZL' + $preCode
                //     });
                // });

                console.log($overallQty,$eachPrice);

                // $.ajax({
                //     type: "get",
                //     url: "http://127.0.0.1:8000/user/ajax/checkout",
                //     data: Object.assign({}, $orderList),
                //     dataType: "json",
                //     success: function(response) {
                //         if(response.status=='true')
                //         window.location = "http://127.0.0.1:8000/user/home";
                //     };

                // });
            })
        })

    </script> --}}

    <script>

        //remove whole cart list
        $("#clearBtn").click(function(){
            $('#dataTable tbody tr').remove();
            $('#subTotal').html("0 Kyats") *1;
            $('#delivery').html("2500 Kyats") *1;
            $('#finalTotal').html("2500 Kyats") *1;

            $.ajax({
                type: "get",
                url: "/user/ajax/clear/cart",
                dataType: "json",
            });
        })

    </script>

@endsection

