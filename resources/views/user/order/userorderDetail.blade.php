@extends('user.layout.master')
@section('title','Order_Details Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content col-10 offset-1">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="">
                        <a href="{{route('order#History')}}"><button class="btn my-3 btn-dark text-white"><i class="fas fa-backward"></i> Back</button></a>
                    </div>
                    <!-- DATA TABLE -->
                    <div class="card" style="width: 400px">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa-solid fa-file-lines mr-3"></i>Order Info
                            </h4>
                        <div class="row mt-3">
                            <div class="col-6">
                                <h5 class="mt-2"><i class="fa-solid fa-user mr-2"></i>Name</h5>
                                <h5 class="mt-2"><i class="fa-solid fa-phone-volume mr-2"></i>Phone</h5>
                                <h5 class="mt-2"><i class="fa-solid fa-location-dot mr-2"></i>Address</h5>
                                <h5 class="mt-2"><i class="fa-solid fa-barcode mr-2"></i>Order Code</h5>
                                <h5 class="mt-2"><i class="fa-solid fa-clock mr-2"></i>Order Date</h5>
                                <h5 class="mt-2"><i class="fa-solid fa-money-bill-wave mr-2"></i>Total</h5>
                            </div>
                            <div class="col-6">
                                <h5 class="mt-2">{{$orderList[0]->user_name}}</h5>
                                <h5 class="mt-2">{{$orderList[0]->Phone}}</h5>
                                <h5 class="mt-2">{{$orderList[0]->Address}}</h5>
                                <h5 class="mt-2">{{$orderList[0]->code}}</h5>
                                <h5 class="mt-2">{{$orderList[0]->created_at->format('d/m/Y')}}</h5>
                                <h5 class="mt-2">{{$orderList[0]->total_price}}</h5>
                            </div>
                          </div>
                          <p class="text-danger mt-2"> <i class="fa-solid fa-triangle-exclamation mr-2"></i>Delivery Fees Excluded</p>
                        </div>

                      </div>


                    {{-- @if (count($menu) != 0) --}}
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2">
                            <thead>
                                <tr class="text-center">
                                    <th>Order Time</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id='dataList'>
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow text-center">
                                        <div class="row">
                                            {{-- <td class="align-middle col-1">{{$o->id}}</td> --}}
                                            <td class="align-middle col-2 offest-1">{{$o->created_at->format('Y.m.d H:i:s')}}</td>
                                            <td class="col-2"><img src="{{asset('storage/'.$o->image)}}" class="img-thumbnail shadow-sm"></td>
                                            <td class="col-2" >{{$o->product_name}}</td>
                                            <td class="col-2">{{$o->quantity}}</td>
                                            <td class="col-2">{{$o->product_price * $o->quantity}} Kyats</td>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
