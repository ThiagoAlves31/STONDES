<?php

namespace App\Http\Controllers\Api;

use App\Lents;
use App\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LentController extends Controller
{
    private $lent;

    public function __construct(Lents $lent){

        $this->lent = $lent;

    }

    
    public function index()

    {   
        try{
            $datas = DB::table('lents')
                ->join('contacts', 'lents.contact_id', '=', 'contacts.contact_id')
                ->join('products','lents.product_id', '=', 'products.product_id')
                ->where('lents.return_date','=',null)
                ->select('lents.*',
                         'products.type',
                         'products.name',
                         'contacts.contact_name',
                         'contacts.contact_phone',
                         'contacts.contact_email')->get();
            
            $data = ['data' => $datas];
            return response()->json($data);
        
        }catch(\Exception $e){
            return response()->json(API\ApiError::errorMessage($e->getMessage(),$e->getMessage()));
        }

    
    }

    public function id($id)
    {
        try{

            $lent = $this->lent->where('lent_id',$id)->first();
            if (!$lent) return response()->json(['data' => ['msg' => 'Empréstimo não encontrado!']],404,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);
            $data = ['data' => $lent];
            return response()->json($data,201);
        
        }catch(\Exception $e){
            return response()->json(API\ApiError::errorMessage($e->getMessage(),$e->getMessage()));
        }

    }

    public function CreateLent(Request $request)
    {   
        try{

            $contactData = $request->all();
            $contact_id = $contactData['contact_id'];
            $product_id = $contactData['product_id'];

            //Verifica se o produto está disponĩvel
            $lent = $this->lent->where(['product_id' => $product_id,'return_date' =>null])->first();

            If ($lent)
            {
                $data = ['data' => ['error'=> 'O produto desejado não está disponível']];
                return response()->json($data,403,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);
            }
            
            $this->lent->Create(['contact_id'=> $contact_id,'product_id' => $product_id]);

            $data = ['data' => ['msg'=> 'Empréstimo do produto concluído com sucesso!']];

            return response()->json($data,201,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);

        }catch(\Exception $e){

            return response()->json(API\ApiError::errorMessage($e->getMessage(),400,'lent'),400);

        }

    }

    public function ReturnLent(Request $request)
    {   
        try{

            $LentData = $request->all();
            $lent_id = $LentData['lent_id'];


            $LentProduct = $this->lent->where(['lent_id' => $lent_id,'return_date' => null]);

            if (!$LentProduct->first())
            {
                $data = ['data' => ['msg'=> 'Produto não encontrado!']];
                return  response()->json($data,404,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);
            }

            $LentProduct->Update(['return_date' => now()]);
            $data = ['data' => ['msg'=> 'Produto recebido com sucesso!']];

            return response()->json($data,201);

        }catch(\Exception $e){

            return response()->json(API\ApiError::errorMessage($e->getMessage(),400,'lent'),400);
        }

    }
}
