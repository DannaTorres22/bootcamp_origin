<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bootcamps = Bootcamp::all();
        return response()->json(["message" => "success" , "data" => $bootcamps ] , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $b = Bootcamp::create([
            "name" => "PHP Laravel Expert",
            "website" => "http://elshaman.org",
            "phone"=>  "5555555",
            "email" =>  "shaman@elshaman.org",
            "address"=> "calle52 # 13 65",
            "average_rating" =>  3.4, 
            "average_cost" =>  15000,
            "user_id" =>  1 
        ]);
        return response()->json( [ "message" => 'sucess' ,  $b ] , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bootcamp = Bootcamp::find($id);
        return response()->json(["message" => "success" , "data" => $bootcamp ] , 200);
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
        $bootcamp = Bootcamp::find($id);
        $bootcamp->name = $request->input('name');
        $bootcamp->save();
        return response()->json([ "message" => 'sucess' , "data" => $bootcamp], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bootcamp = Bootcamp::find($id);
        $bootcamp->delete();
        return response()->json( [ "message" => "success" , "data" => $bootcamp]);
    }
}
