<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        //
        if ($request -> status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }
        // $data = Product::get();
        else {
            $data = Product::orderBy('created_at','asc')->get();
        }
        // return $data;
        //or
        return response()->json($data,200);
    }

    //cart list
    public function cartList(Request $request){
        // logger($request->all());
        $data = $this -> getOrderDate($request);
        // logger($data['product_id']);
        if (Cart::where('product_id', $data['product_id'])->where('user_id',Auth::user()->id)->exists()) {
           $oldQty = Cart::select('quantity')->where('product_id', $data['product_id'])->where('user_id',Auth::user()->id)->get();
           $oldQty = ($oldQty[0]->quantity)*1;
           $newQty = ($data['quantity'])*1;
           $finalQty = $oldQty + $newQty;
           $data['quantity'] = $finalQty;
            Cart::where('product_id', $data['product_id'])->where('user_id',Auth::user()->id)
                ->update(['quantity' => $finalQty]);

        }

        else{
            Cart::create($data);
        }

        $response = [
            'message' => 'Add to Cart Complete.',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    //proceed to checkout
    public function checkout(Request $request){
        $orders = $request->all();
        // logger($orders);
        $finalTotal = 0;
        foreach($orders as $o){
            $finalTotal += $o['total_price'];
        }
        // logger($finalTotal);
        foreach($orders as $o){
            $order = orderList::create([
                'user_id' => $o['user_id'],
                'product_id' => $o['product_id'],
                'quantity' => $o['quantity'],
                'total_price' => $finalTotal,
                'code' => $o['code'],
            ]);
        }


        if($order->total_price < 100000){
            Order::create([
                'user_id' => Auth::user()->id,
                'order_code' => $order -> code,
                'total_price' => $order-> total_price+2500,
            ]);
        }else{
            Order::create([
                'user_id' => Auth::user()->id,
                'order_code' => $order -> code,
                'total_price' => $order-> total_price,
            ]);
        }

        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'true'
        ],200);

    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear each product
    public function clearEachProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where ('product_id',$request->productId)
            ->where ('id',$request->orderId)->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        // logger($request->all());
        $pizza = Product::where('id',$request->productId)->first();
        //need to be array type to update in the table
        $viewCount = [
            'view_count' => $pizza->view_count+1
        ];
        Product :: where ('id',$request->productId) -> update($viewCount);
    }

    //add to favorite
    public function addToFav(Request $request){
        // logger($request);
        $data = $this->getToFavorite($request);
        $realData = product::where ('id',$data['product_id']*1)->first();
        if (Favorite::where('product_id', $data['product_id'])->where('user_id',Auth::user()->id)->exists()) {
            return view('user.main.home');
        }else{
            Favorite::create([
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'description' => $realData -> description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return response()->json([
                'status' => 'true'
            ],200);
            // return view('user.main.home');
        }

    }

    //getting back to UI fav page
    public function viewFavPage(){
        $fav = Favorite::select('favorites.*','p.price as product_price','p.image as product_image','p.name as pizza_name','p.id as p_id')
        ->join('products as p','p.id','favorites.product_id')
        ->where('user_id',Auth::user()->id)
        ->paginate('7');
        // logger($q);

        return view('user.wishlist.wishlist',compact('fav'));
        // return view('user.main.home',compact('q'));
    }

    //clear fav
    public function clearFav(Request $request){
        Favorite::where('user_id',Auth::user()->id)
        ->where ('product_id',$request->productId)
        ->where ('id',$request->favId)
        ->delete();
        return response()->json([
            'status' => 'true'
        ],200);
    }


    //get order data
    private function getOrderDate($request){
        return[
            'user_id' => $request -> userId,
            'product_id' => $request -> pizzaId,
            'quantity' => $request -> count,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()

        ];
    }

    //add to fav data
    private function getToFavorite($request){
        return[
            'user_id' => $request -> userId,
            'product_id' => $request -> pizzaId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
