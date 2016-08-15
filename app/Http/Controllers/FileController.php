<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;

class FileController extends Controller
{
    public function loadMore(Request $request){
        $products=Product::paginate(10);
        $html='';
        foreach ($products as $product) {
            $html.='<li>'.$product->id.' <strong>'.$product->name.'</strong> : '.$product->details.'</li>';
        }
        if ($request->ajax()) {
            return $html;
        }
        return view('loadmore',compact('products'));
    }
}
