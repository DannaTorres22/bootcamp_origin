<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BootcampResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return   $this->resource ;
         return [ 
          
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email
            
          
         ];     
    
    }
}
