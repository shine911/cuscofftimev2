<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subjects;
use App\Courses;
class AdminController extends Controller
{
    public function show($id, Request $request){
        if($id == "subjects"){
            $subjectsCollection = Subjects::with(['Course', 'Course.CourseType'])->get();
            return response()->json($subjectsCollection);
        }
        if($id == "courses"){
            $query = $request->input('q');
            return response()->json(Courses::where('name', 'LIKE', '%'.$query.'%')->get());
        }
    }
}
