<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

use App\Http\Requests;


use App\User;
use App\Item;

class RegisterController extends Controller
{
     public function register(Request $request) {
        $username = $request['username'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $organisation = $request['organisation'];
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = new User;

        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $items = new Item;

        $items->organisation = $organisation;

        $user->items()->save($items);

        return 'Successfully Registered';
    }

}
