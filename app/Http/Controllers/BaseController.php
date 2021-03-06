<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
     /**
     * return error response
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessage=[], $code=404)
    {
       $response =[
        'success'=>true,
        'message'=>$error,
       ];
       if(!empty($errorMessage)){
        $response['data'] = $errorMessage;
       }
       return response()->json($response,200);
    }

    /**
     * success response method.
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result,$message)
    {
        $response = [
            'success'=>true,
            'data'=>$result,
            'message'=>$message,
        ];
        return response()->json($response,200);
    }
}
