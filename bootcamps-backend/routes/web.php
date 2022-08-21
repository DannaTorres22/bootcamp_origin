<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('new_user' , function(){
    $u = new User();
    $u->name="shaman";
    $u->email="cbo@misena.edu.co";
    $u->password = Hash::make("123456");
    $u->save();
    echo $u->id;
});
