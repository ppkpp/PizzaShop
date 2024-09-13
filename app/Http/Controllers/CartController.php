<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    //cart list page
    public function cartListPage(){
        $cartlist = Cart::select('carts.*','p.name as pizza_name','p.price','p.image as product_image')
                    ->leftJoin ('products as p','p.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)->get();
        $total = 0;

        foreach($cartlist as $c){

            $total += $c->price * $c-> quantity;
        }
        $delivery = 0;
        if($total<100000){
            $delivery = 2500;
        }
        else {
            $delivery = 0;
        }
        // dd($total);
        return view ('user.cart.cartPage',compact('cartlist','total','delivery'));
    }
}
