<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //wishtlist page
    public function wishlistPage(){
        return view ('user.wishlist.wishlist');
    }

    //add to favorite
    public function addToFavorite(Request $request,$id){
        dd($request->all());
    }

    //adding to page function
//     private function addingToFav()
 }
