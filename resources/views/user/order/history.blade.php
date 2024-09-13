@extends('user.layout.master')
@section('title','Cart_Page')
@section('content')
<!-- Cart Start -->
<div class="container-fluid">

    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 400px">
            <a href="{{route('user#home')}}" class="">
                <button class="btn btn-dark"><i class="fa-solid fa-backward me-2"></i>Back</button>
            </a>
            <table class="table table-light table-borderless table-hover text-center mb-0 mt-2" id="dataTable" >
                <thead class="thead-dark">
                    <th>Date</th>
                    <th>Order Code</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </thead>
                @foreach ($order as $o)
                <tbody>
                    <td>{{$o->created_at}}</td>
                    <td><a href="{{route('order#info#user',$o->order_code)}}">{{$o->order_code}}</a></td>
                    <td>{{$o->total_price}}</td>
                    <td>
                        @if($o->status == '0')
                        Pending
                        @elseif ($o->status == '1')
                        Accepted
                        @else Rejected
                        @endif
                    </td>
                </tbody>
                @endforeach
            </table>
            <div class="mt-2">
                {{$order->links()}}
            </div>
        </div>

    </div>
</div>
<!-- Cart End -->
@endsection




