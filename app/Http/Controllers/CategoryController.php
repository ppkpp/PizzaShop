<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page

    public function list(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
            })
            ->orderBy('id','desc')->paginate(5);
        $categories->appends(request()->all());
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return view ('admin.category.list',compact('categories','pending','pendingCount'));
    }

    //direct category create page
    public function createPage(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        return view('admin.category.create',compact('pending','pendingCount'));
    }

    //category create

    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data =$this -> requestCategoryData($request);
        Category::create($data);
        return redirect() -> route('category#list')->with(['createSuccess'=>'A category is created...']);
    }

    //delete category

    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Done...']);
    }

    //edit category
    public function editCategory($id){
        $data = Category::where('id',$id)->first();
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        // dd($data);
        return view('admin.category.edit',compact('data','pending','pendingcount'));
    }

    //update category
    public function updateCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data =$this -> requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');

    }

        //category validation
        private function categoryValidationCheck($request){
            Validator::make($request->all(),[
                'categoryName'=>'required|unique:categories,name,'.$request->categoryId
                ])->validate();
            }

        //to convert the data to array type
        private function requestCategoryData($request){
            return[
                'name' => $request->categoryName
            ];
        }
}
