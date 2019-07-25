<?php

namespace App\API;

class ApiError
{
    public static function errorMessage ($message, $code, $request_help = null)
    {	

    	$product_help = ['type' => 'CD|DVD',
    					 'name' => 'Titulo do produto',
 	   					 'description'  => 'Descrição do produto'];

 	   	$lents_help   = ['contact_id'  => 'IDcontato',
 	   				   'product_id'  => 'IDproduto'];

 	   	$contacts_help = ['contact_name'  => 'Nome Da Pessoa',
					      'contact_phone' => '219999999',
					      'contact_email' => 'seuemail@email.com'];

 	   	If ($request_help)
 	   	{	
 	   		($request_help == 'product') ? $help = $product_help : '';
 	   		($request_help == 'lent') 	 ? $help = $lents_help : '';
 	   		($request_help == 'contact') ? $help = $contacts_help : '';

 	   		return ['data' => ['ErrorCode' => $code ,
 	   						   'msg' => $message,	
		                	   'Exemplo JSon' => $help]];
 	   	}else{

        return ['data' => [                
                'msg' => $message,
                'ErrorCode' => $code]];
    	}
    }
} 