<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $token = "meatyhamhock";
        $query = $request->query();
        $challenge = $request->hub_challenge;
        $mode = $request->hub_mode;
        $verify_token = $request->hub_verify_token;
        if ($mode && $verify_token && $challenge) {
            if ($mode == "subscribe" && $verify_token == $token) {
//                return redirect()->route('home');
                return response()->json(['status' => 'success']);
            }
        }else{
            return response()->json(['status' => 'Error']);
        }


    }
}
