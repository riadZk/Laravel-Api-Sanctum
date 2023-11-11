<?php

namespace App\Http\Controllers\Api;



trait Response
{

        public  function apiResponse($data = null,$success = null , $message = null, $status = 200){

                $response = [
                    'data' => $data,
                    'success' => $success,
                    'message' => $message,
                    'status' => $status
                ];

                return response()->json($response,$status);
        }
}
