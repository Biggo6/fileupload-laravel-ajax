<?php

use Illuminate\Http\Request;
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

Route::post('/file/upload', function(Request $request) {
    
    // check if request has file in it
    if($request->hasFile('myphoto')){
        $myfile = $request->file('myphoto');
        // Here you can work with your file as normal

        sleep(3); // This simulate only network delay

        return response()->json([
            "error"=> false
        ]);
    }
    
});
