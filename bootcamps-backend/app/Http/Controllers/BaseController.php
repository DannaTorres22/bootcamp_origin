<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //respnses exitosas
    public function sendResponse($data, $http_status =200){
          //1. construir la respuesta 

          $respuesta = [
            "success" => true, 
            "data" => $data,

          ];
          //2. enviar la response afirmativa al cliente 
          return response()->json($respuesta, $http_status);
    }
    public function sendError($errors, $http_status=404){
          //construir la respuesta de error 

          $respuesta =[
            "success" => false,
            "errors"=> $errors 
          ];
          //enviar la respuesta al cliente 
          return response()->json($respuesta, $http_status);
    }
}
