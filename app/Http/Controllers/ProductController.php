<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product direct
    public function list(){
        $menu = Product::select ('products.*','categories.name as category_name')
            ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('id','desc')
            ->paginate(7);
        $count = count($menu);
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        // $menu->appends($request()->all());
        // $menu = Product::get()->paginate(5);
        return view('admin.product.list',compact('menu','count','pending','pendingCount'));
    }

    //add product page
    public function productCreate(){
        $category = Category::select('id','name')->get();
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return view('admin.product.productCreate',compact('category','pending','pendingCount'));
    }

    //adding new products
    public function addingProduct(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this -> getProducts($request);
        $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
        // dd($data);
        Product::create($data);
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return redirect()->route('product#list',compact('pending','pendingCount'));

    }

    //delete product
    public function deleteProduct($id){
        Product::where ('id',$id)->delete();
        return back() -> with(['deleteSuccess'=>'A product is deleted.']);
    }

    //view products
    public function viewProduct($id){
        $data = Product::where('id',$id)->first();
        // dd($data->toArray());
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return view('admin.product.viewProducts',compact('data',compact('pending','pendingCount')));
    }

    //edit products Page
    public function editProduct($id){
        $data = Product::where('id',$id)->first();
        $category = Category::get();
        // dd($data->toArray());
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
        ->leftJoin ('users as u','orders.user_id','u.id')
        ->where('status', '=', '0')
        ->get();
        $pendingCount = count($pending);
        return view('admin.product.editProduct',compact('data','category','pending','pendingCount'));
    }

    //submit editted product
    public function submitProduct(Request $request){
        // dd($request->toArray());
        // dd($id,$request->toArray());
        $this->productValidationCheck($request,"submit");
        // $data = Product::where('id',$id)->first();
        $toSubmit = $this -> getProducts($request);
        // $request['image'] = $data->image;
        // if(isset($data))
        // dd($toSubmit);
        // dd($request->toArray());
        // $toSubmit['id'] = $request->productId;
        if($request->hasFile('productImage')){
            $oldImage = Product::where('id',$request->productId)->first();
            $oldImage = $oldImage -> image;
            Storage::delete('public/'.$oldImage);
            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $toSubmit['image'] = $fileName;
            // dd($request->file('productImage'));
            // $toSubmit['image'] = $request->productImage;
            // dd($toSubmit);
        }
    //     else $toSubmit['image'] = $data->image;
        // dd($toSubmit);
        // Product::where('id')
        Product::where('id',$request->productId)->update($toSubmit);
        return redirect()->route('product#list');
    }


    //getting data function
    private function getProducts($request){
        return [
            'name' => $request -> productName,
            'price' => $request -> productPrice,
            'category_id' =>$request -> productCategory,
            'description' => $request -> productDescription,
            'waiting_time' => $request -> productWaitingTime,
        ];
    }


    //validation product
    private function  productValidationCheck($request,$action){
        $validationRules = [
                    'productName' => 'required|unique:products,name,'.$request->productId,
                    'productDescription' => 'required',
                    'productPrice' => 'required',
                    'productCategory' => 'required',
                    'productWaitingTime' =>'required'
        ];
        // 'productImage' => 'required|mimes:jpeg,png,jpg,gif|file',
        $validationRules['productImage'] = $action == "create" ? 'required|mimes:jpeg,png,jpg,webp,gif|file' : "mimes:jpeg,png,webp,jpg,gif|file";
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();
    }


}
