<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;
use App\Http\Controllers\BaseController;

class BootcampController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return $this->sendResponse(new BootcampCollection(Bootcamp::all()));
        }catch(\Exception $e){
                return $this->sendError('Server Error', 500);

            }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        
        try{
            return $this->sendResponse(new BootcampResource(
            Bootcamp::create($request->all())
            ), 201);
        }catch(\Exception $th){
            return response()->json([ "success" => false , 
                                      "error" => $e->getMessage()
                                    ] , 400);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        //1. encontrar el bootcamp id
        $bootcamp = Bootcamp::find($id);
        //2. en caso de que el ootcamp no exista

        if(!$bootcamp){
        return $this->sendError("bootcamp whit id:$id not found", 400); 
        }
        return $this->sendResponse(new BootcampResource($bootcamp)); 

        }catch(\Exception $e){
            return $this->sendError('Server Error', 500);
        }
            
            
       
        //$bootcamp = Bootcamp::find($id);
        //return response()->json(["message" => "success" , "data" => $bootcamp ] , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $b = Bootcamp::find($id);
            if(!$b){
                return $this->sendError("bootcamp with id:$id not found", 400);
            }
            //Actualizarlo con update
            $b->update($request->all());
            return $this->sendResponse(new BootcampResource($b)); 
        }catch (\Exception $th) {
            return $this->sendError('Server Error', 500); 
        }
        //Localizar el bootcamp con el id
       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Localizar el bootcamp con el id
        $b = Bootcamp::find($id);
        if(!$b){
            return $this->sendError("bootcamp with id:$id not found", 400);
        }
        //Actualizarlo con delete
        $b->delete();
        return $this->sendResponse(new BootcampResource($b)); 
    }
}
