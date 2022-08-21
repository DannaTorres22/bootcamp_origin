<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    protected $fillable = ['name', 
                           'website' ,
                           'phone' , 
                           'email' , 
                           'address' , 
                           'average_rating' , 
                           'average_cost' , 
                           'user_id' ];
    use HasFactory;
}
