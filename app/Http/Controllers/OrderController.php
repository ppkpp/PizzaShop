<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list
    public function orderList(){

        $orders = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->orderBy('created_at','desc')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->get();
                // dd($orders->toArray());
                // $order_count = count($orders);
                // dd($order_count);
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);

        return view('admin.order.orderList',compact('orders','pending','pendingCount'));
    }

    //change and sort order list
    public function changeOrderList(Request $request){

        // dd($request->orderStatus);
        $orders = Order::select('orders.*','u.id as user_id','u.name as user_name')
        ->orderBy('created_at','desc')
        ->leftJoin ('users as u','orders.user_id','u.id');
        // $pending = Order::whereIn('0', $orders)->get();
        // dd($pending);
        // logger($request['status']);
        if($request->orderStatus == '3'){
            $orders = $orders ->get();
            // dd($orders->toArray());
            // logger(count($orders));
        }
        else{
           $orders = $orders->where('orders.status',$request->orderStatus)->get();
        //    logger(count($orders));
        }
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        // $pending = 0;

        // $count = $orders->status=='0';
        //if($orders->status=='0');
        // $order_count = count($orders);
        return view('admin.order.orderList',compact('orders','pending','pendingCount'));
    }

    //order info admin
    public function orderInfo($orderCode){
        // dd($orderCode);
        $orderList = orderList::select('order_lists.*','u.id as user_id','u.name as user_name','u.phone as Phone','u.address as Address','p.name as product_name','p.image','p.price as product_price')
        ->leftjoin ('users as u','order_lists.user_id','u.id')
        ->leftjoin ('products as p', 'order_lists.product_id','p.id')
        // ->leftjoin ('orders as o','o.order_code','order_lists.code')
        ->where('code',$orderCode)
        ->get();
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        // $eachAmt = $orderList
        // dd($orderList);
        return view('admin.order.orderDetail',compact('orderList','pending','pendingCount'));
    }

    //order info user
    public function orderInfoUser($orderCode){
        // dd($orderCode);
        $orderList = orderList::select('order_lists.*','u.id as user_id','u.name as user_name','u.phone as Phone','u.address as Address','p.name as product_name','p.image','p.price as product_price')
        ->leftjoin ('users as u','order_lists.user_id','u.id')
        ->leftjoin ('products as p', 'order_lists.product_id','p.id')
        // ->leftjoin ('orders as o','o.order_code','order_lists.code')
        ->where('code',$orderCode)
        ->get();
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        // $eachAmt = $orderList
        // dd($orderList);
        return view('user.order.userorderDetail',compact('orderList','pending','pendingCount'));
    }


    //ajax change status
    public function ajaxChangeStatus(Request $request){
        // logger($request);
        Order::where('id',$request->orderId)->update([
            'status' => $request ->status
        ]);

        // $orders = Order::select('orders.*','u.id as user_id','u.name as user_name')
        // ->orderBy('created_at','desc')
        // ->leftJoin ('users as u','orders.user_id','u.id')
        // -> get();

        // return response()->json([
        //     'status' => 'true'
        // ],200);

    }

}
