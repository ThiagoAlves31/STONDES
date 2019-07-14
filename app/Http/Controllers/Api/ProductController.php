<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{   
    private $product;

    public function __construct(Product $product){

        $this->product = $product;

    }

    
    public function index()
    {

        $data = ['data' => $this->product->paginate(10) ];
        return response()->json($data);
    
    }

    public function id($id)
    {
        $product = $this->product->where('product_id',$id)->first();

        if (!$product) return response()->json(['data' => ['msg' => 'Produto nao encontrado!']],404);
        $data = ['data' => $product];
        return response()->json($data);

    }

    public function InsertProduct(Request $request)
    {   
        try{

            $productData = $request->all();
            $this->product->Create($productData);
            
            $data = ['data' => ['msg'=> 'Produto inserido com sucesso!']];

            return response()->json($data,201);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage(),1010));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na inserção dos dados',1010));

        }

    }

    public function UpdateProduct(Request $request,$id)
    {   
        try{
            
            $productData = $request->all();
            $product     = $this->product->where('product_id',$id);

            $product->Update($productData);
            
            $data = ['data' => ['msg'=> 'Produto atualizado com sucesso!']]; 
            return response()->json($data,201);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage()));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na atualização dos dados'));

        }

    }

    public function DeleteProduct(Request $request,$id)
    {   
        try{
            
            $productData = $request->all();
            $product     = $this->product->where('product_id',$id);

            if(!$product) return response()->json(['data' => ['msg' => 'Produto ID '.$id.' nao encontrado!']],404);

            $product->Delete($productData);
            
            $data = ['data' => ['msg'=> 'Produto removido com sucesso!']]; 
            return response()->json($data,200);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage()));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na exclusão dos dados'));

        }

    }
}
