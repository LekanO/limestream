<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Image;
use App\UserImage;
use App\User;
use App\File;

use App\Http\Requests;

class UserController extends Controller
{    

    public function create(Request $request) {

            $user = Auth::user();
            // validating
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:255',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'organisation' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|max:255'
            ]);
            $username = $request['username'];
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $organisation = $request['organisation'];
            $email = $request['email'];
            $password = bcrypt($request['password']);

            $password = $request['password'];
            $cpassword = $request['cpassword'];
            
            if($password!=$cpassword)
            { 
                return response()->json(['error'=> 'Password and Confirm password are not match']);                
            }else{
                $user = array(
                'username' => $username, 
                'first_name' => $first_name,
                'last_name' => $last_name,
                'organisation' => $organisation,
                'email' => $email,
                'password' => bcrypt($request['password'])
            );
            if($id = DB::table('users')->insert($user))
            {
                return response()->json(['status' => 'Registration Successfull... Please Login'], 200);
            }else{
                return response()->json(['status' => 'Registration Failled... Please try again'], 400);
            }
        }
    }
}
