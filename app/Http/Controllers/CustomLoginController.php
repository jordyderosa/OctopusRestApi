<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
       // return $request->all();

        $query="SELECT * from users where email='".$request['email']."' AND authtoken='".$request['authtoken']."'";
        if(DB::statement($query))
        {
            // Authentication passed...
            return redirect()->route('custom-home');
           // return view('custom.home');
        }

    }
    public function index()
    {
        return view('customhome');
    }
}
