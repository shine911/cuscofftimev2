<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $query = $request->input('q');
        return response()->json(User::where('name', 'LIKE', '%'.$query.'%')->get());
    }
}
