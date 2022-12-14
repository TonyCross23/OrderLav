<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function PizzaList (Request $request){

        if ($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }
}
