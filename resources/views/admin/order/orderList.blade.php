@extends('admin.layouts.app')
@section('title','Product_List Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="col-5 table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-1 pt-2 shadow-sm text-center">
                            <i class="fas fa-database"></i> - {{count($orders)}}
                        </div>
                        {{-- <div class="col-3 pt-2 d-flex">
                            <span class="mr-3">SortedBy</span>
                            <div class="select_box" style="width: 50px">
                                <select name="" id="ajaxStatus">
                                    <option value="3">All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Accepted</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                            <button class="btn sm bg-dark text-white">Search</button>
                        </div> --}}

                        <form action="{{route('change#order#list')}}" method="post" class=" offset-1 col-3 pt-2">
                            @csrf
                            <div class="input-group">
                                <select class="form-select form-control" name="orderStatus" style="width :150px" aria-label="Example select with button addon">
                                    <option value="3" @if (request('orderStatus') == '3') selected @endif>All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accepted</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Rejected</option>
                                </select>
                                <button class="btn btn-dark text-white" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="col-3 text-center pt-2">
                            Searching for : <a class="text-danger"></a>
                        </div>
                        <div class="col-4 px-5">
                            <form action="" class="form-coontrol input-lg">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name='key' class="text-muted" placeholder="Searching for..." value="">
                                    <button type="submit" class="btn btn-dark text-white">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    {{-- @if (count($menu) != 0) --}}
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2">
                            <thead>
                                <tr class="text-center">
                                    <th>Order Date</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id='dataList'>
                                @foreach ($orders as $o)
                                    <tr class="tr-shadow text-center">
                                        <td>{{$o->created_at->format('d/m/Y')}}</td>
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{$o->user_id}}</td>
                                        <td>{{$o->user_name}}</td>
                                        <td><a href="{{route('order#info',$o->order_code)}}">{{$o->order_code}}</a></td>
                                        <td >{{$o->total_price}} Kyats</td>
                                        <td>
                                            <select name="status" id="status" class="form-control changeforEach">
                                                <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>Accepted</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>Rejected</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                    {{-- @else
                        <div class="mt-5">
                            <h3 class="text-center">There is no product here.</h3>
                        </div>
                    @endif --}}
                    <!-- END DATA TABLE -->

                    {{-- pagination box --}}
                    {{-- {{$orders->links()}} --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSource')
    <script>

        $(document).ready(function(){
            $('#ajaxStatus').change(function(){
                $status  = $('#ajaxStatus').val();
                // console.log($status);
                $.ajax({
                    type : 'get' ,
                    url : '/admin/ajax/order/list' ,
                    data : {
                        'status' : $status ,
                    } ,
                    dataType : 'json' ,
                    success : function (response){
                        // console.log(response);
                        $list = '';
                        for ($i=0;$i<response.length;$i++){
                            $date = new Date(response[$i].created_at);

                            if($date.getMonth() <= 9){
                                $finalDate = $date.getDate() + "/0" + $date.getMonth() + "/" + $date.getFullYear();
                            }
                            else {
                                $finalDate = $date.getDate() + "/" + $date.getMonth() + "/" + $date.getFullYear();
                            }

                            if(response[$i].status == 0){
                                $statusMessage = `
                                    <select name="status" id="status" class="form-control changeforEach">
                                        <option value="0" selected>Pending</option>
                                        <option value="1" >Accepted</option>
                                        <option value="2" >Rejected</option>
                                    </select>
                                `;
                            }else if (response[$i].status == 1){
                            $statusMessage = `
                                <select name="status" id="status" class="form-control changeforEach">
                                    <option value="0" >Pending</option>
                                    <option value="1" selected>Accepted</option>
                                    <option value="2" >Rejected</option>
                                </select>
                                `;
                            }else if (response[$i].status == 2){
                                $statusMessage = `
                                <select name="status" id="status" class="form-control changeforEach">
                                    <option value="0" >Pending</option>
                                    <option value="1" >Accepted</option>
                                    <option value="2" selected>Rejected</option>
                                </select>
                                `;
                            }

                            $list += `
                            <tr class="tr-shadow">
                                <td>${$finalDate}</td>
                                <input type="hidden" class="orderId" value="${response[$i].id}">
                                <td>${response[$i].user_id}</td>
                                <td>${response[$i].user_name}</td>
                                <td>${response[$i].order_code}</td>
                                <td >${response[$i].total_price} Kyats</td>
                                <td>${$statusMessage}</td>
                            </tr>`;
                        }
                        $('#dataList').html($list);
                    }
                })
            })

            $('.changeforEach').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'status' : $currentStatus ,
                    'orderId' : $orderId ,
                };

                $.ajax({
                    type:'get',
                    url : '/admin/ajax/change/status',
                    data: $data,
                    dateType: 'json',
                    success : function (response){
                        location.reload();
                    }
                })
            })
        })
    </script>
@endsection
