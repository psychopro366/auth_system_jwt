<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class BaseController extends Controller
{
   /**
    * Send Response to the client
    * @param array $result response result
    * @param string $essage success message
    * @return array response array
    */
   protected function sendResponse($result, $message): JsonResponse {
   	
   	// make response 
   	$response = [
   		'success' => true,
   		'data' => $result,
   		'message' => $message
   	];

   	// Return response
   	return response()->json($response, 200);
   }


   /**
    * Send error to the client 
    * @param string $error 
    * @return array [error response]
    */
   protected function sendError($error, $customErrMsg = [], $code = 404): JsonResponse {
   	
   	// Error response
   	$response = [
   		'success' => false,
   		'message' => $error
   	];

   	// Check if $customErrMsg exists
   	if (!empty($customErrMsg)) {
   		$response['data'] = $customErrMsg;
   	}

   	// Return error response
   	return response()->json($response, $code);
   }
}
