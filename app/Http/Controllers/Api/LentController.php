<?php

namespace App\Http\Controllers\Api;

use App\Lents;
use App\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LentController extends Controller
{
    private $lent;

    public function __construct(Lents $lent){

        $this->lent = $lent;

    }

    
    public function index()
    {
        
        $data = ['data' => $this->lent->where('return_date',null)->paginate(10) ];
        return response()->json($data);
    
    }

    public function id($id)
    {

        $lent = $this->lent->where('lent_id',$id)->first();
        if (!$lent) return response()->json(['data' => ['msg' => 'Emprestimo nao encontrado!']],404);
        $data = ['data' => $lent];
        return response()->json($data);

    }

    public function CreateLent(Request $request)
    {   
        try{

            $contactData = $request->all();
            $contact_id = $contactData['contact_id'];
            $product_id = $contactData['product_id'];

            //return response()->json($contact_id);
            
            $this->lent->Create(['contact_id'=> $contact_id,'product_id' => $product_id]);
            
            //$this->lent->Create($contactData);
            $data = ['data' => ['msg'=> 'Contato inserido com sucesso!']];

            return response()->json($data,201);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage(),1010));
            }

            return response()->json(API\ApiError::errorMessage($e->getMessage(),1010));

        }

    }
}
