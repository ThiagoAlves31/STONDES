<?php

namespace App\Http\Controllers\Api;

use App\Contacts;
use App\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Contacts $contact){

        $this->contact = $contact;

    }

    
    public function index()
    {
        
        $data = ['data' => $this->contact->all() ];
        return response()->json($data);
    
    }

    public function id($id)
    {
        $contact = $this->contact->where('contact_id',$id)->first();

        if (!$contact) return response()->json(['data' => ['msg' => 'Contato nao encontrado!']],404,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);
        $data = ['data' => $contact];
        return response()->json($data);

    }

    public function InsertContact(Request $request)
    {   
        try{

            $contactData = $request->all();
            $this->contact->Create($contactData);
            
            $data = ['data' => ['msg'=> 'Contato inserido com sucesso!']];

            return response()->json($data,201);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage(),1010));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na inclusão do contato',1010));

        }

    }

    public function UpdateContact(Request $request,$id)
    {   
        try{
            
            $contactData = $request->all();
            $contact     = $this->contact->where('contact_id',$id);

            $contact->Update($contactData);
            
            $data = ['data' => ['msg'=> 'Contato atualizado com sucesso!']]; 
            return response()->json($data,201);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage()));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na atualização dos dados'));

        }

    }

    public function DeleteContact(Request $request,$id)
    {   
        try{
            
            $contactData = $request->all();
            $contact     = $this->contact->where('contact_id',$id);

            if(!$contact) return response()->json(['data' => ['msg' => 'Contato nao encontrado!']],404,array('Content-Type' => 'application/json;charset=utf8'),JSON_UNESCAPED_UNICODE);

            $contact->Delete($contactData);
            
            $data = ['data' => ['msg'=> 'Contato removido com sucesso!']]; 
            return response()->json($data,200);

        }catch(\Exception $e){
            
            if(config('app.debug')){
                return response()->json(API\ApiError::errorMessage($e->getMessage()));
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro na exclusão dos dados'));

        }

    }
}
