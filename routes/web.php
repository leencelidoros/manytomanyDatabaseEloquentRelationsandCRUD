<?php

use App\Models\User;
use  App\Models\Role;
use Illuminate\Support\Facades\Route;

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
//Create
Route::get('/create',function (){
    $user=User::find(1);
    $role= new Role(['name'=>'Adminstrator']);

    $user->roles()->save($role);
});
//Read
Route::get('/read',function (){
    $user=User::findorFail(1);

    foreach ($user->roles as $role)
    {
        return($user->roles);
    }

});
Route::get('/update',function (){
   $user=User::findorFail(1);
   if($user->has('roles')){
       foreach ($user->roles as $role){
           if($role->name='Adminstrator')
           {
               $role->name='subscriber';
               $role->save();
           }
       }
   }
});
//Deletes All Data in the Database
Route::get('/delete',function (){
    $user= User::findorFail(1);
    $user->roles()->delete();
});
Route::get('/delete1',function (){
    $user= User::findorFail(1);
    foreach ($user ->roles as $role){
        $role->whereid(4)->delete();
    }

});
//Attaching Synching and detaching
//Attach
Route::get('/attach',function (){
    $user=User::findorFail(1);
    $user->roles()->attach(4);
});
//Dettaching
//
Route::get('/dettach',function (){
    $user=User::findorFail(1);
    $user->roles()->detach();
});

//Synching--

Route::get('/sync',function (){
   $user=User ::findorFail(1);
   $user->roles()->sync(5);
});

