<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function ApiResponse($data=null,$message=null,$status)
    {

        $array=[
         'data'=>$data,
         'message'=>$message,
         'status'=>$status
        ];
        return response($array);
    }
    public function multiableLanguageApiResponse($data=null,$ar_message = null,$en_message = null,$status)
    {
        $array=[
            'data'=>$data,
            'ar_message'=>$ar_message,
            'en_message'=>$en_message,
            'status'=>$status
        ];
        return response($array);
    }
}
