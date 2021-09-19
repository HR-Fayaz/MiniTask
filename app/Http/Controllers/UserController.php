<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::get();
    }

     
    /**
     * Display a list of the founded resource.
     *
     * @param  App\Models\User $id  =  id of Resource 
     * @return \Illuminate\Http\Response
     */
    public function listOne($id)
    {
        //
        return User::FindOrfail($id);
    }

    /**
     * Display a list of the founded resource.
     *
     * @param  App\Models\User $id  =  id of Resource 
     * @return \Illuminate\Http\Response
     */
    public function listtasks($id)
    {
        //
        $user=User::FindOrfail($id);
        return $user->Todos()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData=$request->validate([
            'name'=>'required',
            'lName'=>'required',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'level'=>'required'    
        ]);

        $validatedData["password"]=Hash::make($validatedData["password"]);
        $user=User::create($validatedData);

        $accesstoken=$user->createtoken("accesstoken")->accessToken;

        return response(["User :"=>$user,"Access Token :"=>$accesstoken]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $id=  id of Edited Resource 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user=User::FindOrfail($id);
          //
          $validatedData=$request->validate([
            'email'=>'email|required|unique:users',
            'password'=>'required'
        ]);

        $validatedData["password"]=Hash::make($validatedData["password"]);
        $user->update($validatedData);

        return response(["status"=>"Updated","User :"=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $id  =  id of Deleted Resource 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $user=User::findOrFail($id);
            if($user->delete()){
                return response(["status"=>"success","message"=>"Your Record Deleted Successfully"]);
            }
        }
        catch(\Exception $er){
            return response(["status"=>"error","message"=>($er->getMessage())]);
        }
    }
}
