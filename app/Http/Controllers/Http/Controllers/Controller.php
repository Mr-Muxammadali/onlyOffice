<?php

namespace App\Http\Controllers\Http\Controllers;

abstract class Controller
{
    public function success($data, $code = 200, $message = 'success'){
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    public function error($code = 500, $message = 'error',$data = null){
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
