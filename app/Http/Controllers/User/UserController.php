<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function userHome(){
        $pizza = Product::select ('products.*')
        ->when(request('key'),function($query){
        $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('id','desc')
        ->get();
        $category  = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        $fav = Favorite::where('user_id',Auth::user()->id)->get();
        $fav_count = count($fav);
        $quantity = 0;

        foreach($cart as $c ){
            $quantity += ($c['quantity']);
        }


        return view('user.main.home',compact('pizza','category','cart','quantity','order','fav_count'));
        // return view('user.layout.master',compact('quantity'));
    }

    //look user profile
    public function lookProfile(){
        User::where ('id',Auth::user()->id)->get();
        return view('user.main.profile');
        // dd($userData->toArray());
    }

    //edit profile
    public function editProfile($id){
        return view('user.main.edit');
    }

    //submit new profile
    public function submitProfile($id, Request $request){
        $this -> newDataValidation($request);
        $userData = $this -> getNewData($request);

        if($request->hasFile('image')){
            $oldImage = User::where('id',Auth::user()->id)->first();
            $oldImage = $oldImage -> image;
            Storage::delete('public/'.$oldImage);
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $userData['image'] = $fileName;
        }
        User :: where ('id',$id) -> update($userData);
        // dd($userData);
        // return view('user.main.profile',compact('userNewData'))->with(['updateSuccess' => 'Your Profile is Updated. Please check well for the right directory of your orders.']);
        return redirect()->route('look#profile',Auth::user()->id)->with(['updateSuccess' => 'Your Profile is Updated. Please check well for the right directory of your orders.']);
    }

    //user password change
    public function changeUserPassword(){
        return view ('user.main.changePassword');
    }

    //submit user password
    public function submitUserPassword(Request $request){
        $this -> passwordValidationCheck($request);
        $userPw = User::select('password')->where ('id',Auth::user()->id)->first();
        $hashOldPw = $userPw -> password;
        if( Hash::check($request->oldPassword, $hashOldPw)){
            User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->newPassword)
            ]);
            return redirect()->route('change#UserPassword')->with(['changePassword'=>'Your password is CHANGED']);
        }
        else
            return redirect()->route('change#UserPassword')->with(['failPassword'=>'Your password is incorrect']);
    }

    //filter pizzas by category
    public function pizzaFilter($id){

        $pizza = Product::where ('category_id',$id)->orderBy('price','asc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $fav = Favorite::where('user_id',Auth::user()->id)->get();
        $fav_count = count($fav);
        $quantity = 0;
        $order = Order::where('user_id',Auth::user()->id)->get();

        foreach($cart as $c ){
            $quantity += ($c['quantity']);
        }
        return view('user.main.home',compact('pizza','category','quantity','order','fav_count'));
    }

    //product details
    public function productDetail($productId){
        $pizza = Product::where('id',$productId)->first();
        $cartlist = Cart::select('carts.user_id','carts.quantity','p.id as product_id')
        ->leftJoin ('products as p','p.id','carts.product_id')
        ->where('user_id',Auth::user()->id)->get();
        $category = Category::select('id')->where('id',$pizza->category_id)->first();
        // dd($category->id);
        $categoryId = $category->id;
        $pizzaList = Product::where('category_id',$categoryId)->where('id','!=',$pizza->id)->get();
        $fav = Favorite::where('user_id',Auth::user()->id)->get();
        $fav_count = count($fav);
        $allList = Product::get();
        // dd($pizzaList->toArray());
        return view('user.main.details',compact('pizza','pizzaList','allList','fav_count'));
    }

    //cart list page
    public function cartListPage(){
        $cartlist = Cart::select('carts.*','p.name as pizza_name','p.price','p.image as product_image')
                    ->leftJoin ('products as p','p.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)->get();
        // dd($cartlist->toArray());
        $total = 0;
        foreach($cartlist as $c){
            // dd($c->toArray());
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

     //order history
     public function orderHistory(){
        $order = Order::where('user_id',Auth::user()->id)
        -> orderBy ('created_at','desc')
        ->paginate('5');
        // $totalOrder = count($order);
        return view ('user.order.history',compact('order'));
    }

    //change user to admin (userlist)
    public function userList(){
        $users = User::where('role','<>','admin')->paginate('10');
        // dd($users->role);
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return view ('admin.users.userList',compact('users','pending','pendingCount'));
    }

    //user change role (data carry by ajax)
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateRole = [
            'role' => $request -> role
        ];
        User::where('id',$request->userId)->update($updateRole);

    }

    //detatil from fav
    public function detailFromFav($id){
        dd($id);
    }


    //getNewData
    private function getNewData($request){
        return[
            'name' => $request -> name,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'gender' => $request -> gender,
            'address' => $request -> address,
            'image' => $request -> image
        ];
    }

    //new data validation
    private function newDataValidation($request){
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'updated_at' => Carbon::now(),
        ])->validate();
    }

    //password Validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }
}
