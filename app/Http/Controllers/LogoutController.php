<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Requests;

use App\Live;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    /**
     * Update status
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $auth = Auth::user()->id;
        $status = "Offline";

        $input = array (
            'status' => $status
        );

        Live::where("user_id",$auth)->update($input);
    }
    
}
 