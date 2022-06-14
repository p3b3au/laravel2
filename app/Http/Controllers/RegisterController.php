<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use App\Models\User;

class RegisterController extends BaseController
{
    
    /**
     * register api
     *
     * @param Request $request
     * @return Illuminate\Http\Request;
     */
    public function register(Request $request){
        // validate data
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails()){
            return $this->sendError('validation error', $validator->errors());
        }// input data in bdd and return token
            $input = $request->all();
            $input['password']= bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MySecretKey')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'user registered succefully');       
    }

    /**
     * login api
     *
     * @param Request $request
     * @return Illuminate\Http\Request;
     */
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MySecretKey')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'user logged succefully');    
        }else{
            return $this->sendError('Unauthorized',['error'=>'unauthorized']);
        }

        // validate data
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails()){
            return $this->sendError('validation error', $validator->errors());
        }// input data in bdd and return token
            $input = $request->all();
            $input['password']= bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MySecretKey')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'user registered succefully');       
    }
}
