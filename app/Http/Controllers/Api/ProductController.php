<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{   
    private $product;

    public function __construct(Product $product){

        $this->product = $product;

    }

    public function index(){

        $data = ['data' => $this->product->paginate(5) ];
        return response()->json($data);
    
    }

    public function id(Product $id){
        
         $data = ['data' => $id ];
        return response()->json($data);

    }
}
