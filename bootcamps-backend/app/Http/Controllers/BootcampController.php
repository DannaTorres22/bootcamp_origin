<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            //return new  BootcampCollection( Bootcamp::all());
            return response()->json( new BootcampCollection(Bootcamp::all()) , 200);
        }
        catch(Exception $e){
            
            return response()->json([ "success" => false , 
                                      "error" => $e->getMessage()
                                    ] , 400);
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
            $b = Bootcamp::create($request->all());
            return response()->json([ "success" => true ,  "data" =>  new BootcampResource($b)    ] , 201);
        }catch(Exception $e){
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
            $bootcamp = Bootcamp::find($id);
            if($bootcamp){
                return response()->json(['success' => true, 
                                     'data' =>  new BootcampResource($bootcamp)] , 200); 
            }else{
                return response()->json(['success' => false, 
                                         'error' => "not found bootcamp with id: $id"
                                         ] 
                                         , 400); 
            }
            
        }
        catch(Exception $e){    
            return response()->json([ "success" => false , 
                                       "error" => $e->getMessage()
                                    ] , 400);
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
        try{ 
            $bootcamp = Bootcamp::find($id);
            if(!$bootcamp){
                return response()->json([ "success" => false , 
                                          "error" => "not found bootcamp with id : $id"
                                        ] , 400);
            }else{
                $bootcamp->update(
                    $request->all()
                 ); 
                 return response()->json([ "success" => true ,  
                                      new BootcampResource($bootcamp)  
                                    ]);
            }      
        } catch(Exception $e){    
            return response()->json([ "success" => false , 
                                      "error" => $e->getMessage()
                                    ] , 400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{ 
            $bootcamp = Bootcamp::find($id);
            if(!$bootcamp){
                return response()->json([ "success" => false , 
                                          "error" => "not found bootcamp with id : $id"
                                        ] , 400);
            }else{
                $bootcamp->delete(); 
                return response()->json([ "success" => true ,  
                                      new BootcampResource($bootcamp)  
                                    ]);
            }      
        } catch(Exception $e){    
            return response()->json([ "success" => false , 
                                      "error" => $e->getMessage()
                                    ] , 400);
        }
    }
}
