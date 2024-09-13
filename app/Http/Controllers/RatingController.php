<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    //contact
    public function contactPage(){
        return view ('user.contact.contact');
    }

    //submit from contact
    public function submitDescription(Request $request){
        // dd($request->all());
        $this->submitValidation($request);
        $contact = $this->createData($request);
        // dd($contact);
        Rating::create($contact);
        return redirect() -> route('user#home')->with(['createSuccess'=>'Your Suggestion is successfully submitted....']);
    }

    //suggestions
    public function userSuggestion(){
        $contact = Rating::paginate('10');
        $pending = Order::select('orders.*','u.id as user_id','u.name as user_name')
                ->leftJoin ('users as u','orders.user_id','u.id')
                ->where('status', '=', '0')
                ->get();
        $pendingCount = count($pending);
        // dd($contact->toArray());
        return view ('admin.users.suggestion',compact('contact','pending','pendingCount'));
    }

    //submit data validation
    private function submitValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ])->validate();
        }

    //submit data to table
    private function createData($request){
        return[
            'name' => $request->name,
            'phone_number' =>$request->phone,
            'email' =>$request->email,
            'message' =>$request->description,
        ];
    }



}
