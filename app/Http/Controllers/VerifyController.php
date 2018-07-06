<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token){
        $user = User::where('token','=',$token)->firstorFail();
        $user->token=null;
        $user->save();
        return redirect('/home');


    }
}
