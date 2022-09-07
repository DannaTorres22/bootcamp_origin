<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try 
        {
            return $this->sendResponse(new CourseCollection(Course::all()));
        } 
        catch (\Exception $e) 
        {
            return $this->sendError('Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $curso = new  Course();
        $curso->bootcamp_id = $id;
        $curso->title = $request->title;
        $curso->description = $request->description;
        $curso->weeks = $request->weeks;
        $curso->enroll_cost = $request->enroll_cost;
        $curso->minimum_skill = $request->minimum_skill;
        $curso->save();

        return response()->json(["success" => true, "data" => $curso], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            $curso=Course::find($id);
            if(!$curso)
            {
                return  $this->sendError( "course widt id: $id not found", 400);
            }
            return $this->sendResponse(new CourseResource($curso));
        }
        catch (\Exception $e)
        {
            return  $this->sendError("Serve Error", 500);
        }
        
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
            $b = Course::find($id);
            if(!$b){
                return $this->sendError("Course with id:$id not found", 400);
            }
            //Actualizarlo con update
            $b->update($request->all());
            return $this->sendResponse(new CourseResource($b)); 
        }catch (\Exception $th) {
            return $this->sendError('Server Error', 500); 
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
        try
        {
            $b=Course::find($id);
            if(!$b)
            {
                return $this->sendError("course widt id: $id not found", 400);
            }
            $b->delete();
            return $this->sendResponse(new CourseResource($b));
        }
        catch (\Exception $e) 
        {
            return $this->sendError('Server error', 500);
        }
    }
}