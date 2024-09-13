<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin password change

    public function adminPasswordChange(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        return view ('admin.profile.change',compact('pending','pendingCount'));
    }

    //admin password submit
    public function adminPasswordSubmit(Request $request){
        $this->changePasswordValidation($request);
        $clientId=Auth::user()->id;
        $clientData = User::select('password')->where('id',$clientId)->first();
        $hasholdPw = $clientData -> password;

        if(Hash::check($request->oldPassword, $hasholdPw)){
            User::where('id',$clientId)->update([
                        'password' => Hash::make($request->newPassword)
                    ]);
                // Auth::logout();
                return redirect()->route('category#list')->with(['changeSuccess'=>'The password has been changed.']);
        }else
            return redirect()->route('admin#passwordChange')->with(['wrongOldPassword'=>'Your password is incorrect!']);
    }

    //cancel to change
    // public function cancelPasswordChange(){
    //     return view ('admin.category.list');
    // }

    //confirm to change?
    // public function confirmToChange(){
    //     return view('admin.password.confirm');
    // }

    //admin details
    public function adminDetails(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        return view('admin.profile.detail',compact('pending','pendingCount'));
    }

    public function editAdminProfile(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        return view('admin.profile.editprofile',compact('pending','pendingCount'));
    }

    public function updateAdminProfile($id, Request $request){
        $this->updateProfileValidation($request);
        $newData = $this->getNewData($request);

        //image check and insert new image
        if($request->hasFile('image')){

            $dbImage=User::where('id',$id)->first();
            $dbImage = $dbImage -> image;

            if($dbImage != null){
                Storage::delete(['public/', $dbImage]);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $newData['image'] = $fileName;
        }
        User::where('id',$id)->update($newData);
        return redirect()->route('admin#Details')->with(['updateSuccess'=>'Admin profile is updated...']);
    }

    //admin list
    public function adminList(){
        $admin = User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
            })
            ->where('role','admin')
            ->orderBy('id','desc')->paginate(5);
            $admin->appends(request()->all());

        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        return view('admin.profile.adminList',compact('admin','pending','pendingCount'));
    }

    //delete admin
    public function delete($id){
        User::where ('id',$id)->delete();
        return redirect() -> route('admin#list');
    }

    //change role
    public function changeRole($id){
        $data = User::where ('id',$id)->first();
        // dd($data->toArray());
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        return view ('admin.profile.roleChange',compact('data','pending','pendingCount'));
    }

    //submit role
    public function submitRole($id,Request $request){
        $newRole = $this -> getNewRole($request);
        User :: where ('id',$id) ->update($newRole);
        return redirect() -> route('admin#list');
    }

    //getting the pending request alert
    public function pending(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
            ->leftJoin ('users as u','orders.user_id','u.id')
            ->where('status', '=', '0')
            ->get();
        $pendingCount = count($pending);
        // dd($pendingCount);
        // $orders = Order::select('orders.status as status','u.id as user_id','u.name as user_name')
        // ->orderBy('created_at','desc')
        //
        // return redirect() -> route('view#pending',compact('pending','pendingCount'));
    }

    //to view pendingOrder
    public function pendingList(){
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
        ->leftJoin ('users as u','orders.user_id','u.id')
        ->where('status', '=', '0')
        ->get();
        $pendingCount = count($pending);
        return view('admin.order.pendingOrder',compact('pending','pendingCount'));
    }

    //get new role
    private function getNewRole($request){
        return [
            'role' => $request -> role
        ];
    }

    //changePasswordValidation
    private function changePasswordValidation($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    //to get the new data
    private function getNewData($request){
        return[
            'name' => $request -> name,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'gender' => $request -> gender,
            'address' => $request -> address
        ];
    }

    //update profile validation
    private function updateProfileValidation($request){
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

}
