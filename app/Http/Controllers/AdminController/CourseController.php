<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Courses;
class CourseController extends Controller
{
    //
    public function index(Request $request){
        if($request->has('q')){
            $query = $request->input('q');
            return response()->json(Courses::where('name', 'LIKE', '%'.$query.'%')->get());
        }
        return response()->json(Courses::with('CourseType')->get());
    }
}
