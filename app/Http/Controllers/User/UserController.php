<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // json request
        $users= User::all();
        return $this->showAll($users);
        // return $users
        // 200 response means iit is ok
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create response for by json response
        // validation
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ]);
        $data= $request->all();
        $data['password']= bcrypt($request->password);
        $data['verified']= User::UNVERIFIED_USER;
        $data['verification_token']= User::generateVerificationCode();
        $data['admin']= User::REGULAR_USER;

        $user= User::create($data);
        return $this->showOne($user, 201);
         // 201 response means it has been created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    //   $user= User::findOrFail($id);
    // model binding
    public function show(User $user)
    {
        //
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // model binding
    public function update(Request $request, User $user)
    {
        // validate active user
        // some fields are not required
        // $user= User::findOrFail($id);
        $rules= [
            'email'=>'email|unique:users,email,' . $user->id,
            'password'=>'min:6|confirmed',
            // check if it's an admin or regular user
            'admin'=> 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER
        ];
        $this->validate($request,$rules);
        // writing queries
        if($request->has('name')){
            $user->name= $request->name;
        }
        if($request->has('email') && $user->email != $request->email){
            $user->verified= User::UNVERIFIED_USER;
            // since the email is different from the input email, then generate a new token 
            $user->verifiaction_token= User::generateVerificationCode();
            // then enter a new enmail or update the emial field
            $user->email= $request->email;
        }
        if($request->has('password')){
            $user->password= bcrypt($request->password);
        }
        if($request->has('admin')){
            if(!$user->isVerified){
                return $this->errorResponse(['error'=>'Only the user can modify the admin field', 'code'=>409], 409);
            }
            $user->admin= $request->admin;
        }
        // if something changes during upade then it it represented by the idDirty()
        // checks if the was an upadte done
        if(!$user->isDirty()){
            return  $this->errorResponse(['error'=>'You need to specify a deferent value to update', 'code'=>422], 422);
        }
        $user->save();
        return $this->showOne($user);
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        // $user= User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }
}
