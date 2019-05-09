<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Courses;

use App\Subjects;

class SubjectController extends Controller
{
    //
    public function index(Request $req){
        if($req->has('q')){
            $subjectsCollection = Subjects::with(['Course', 'Course.CourseType'])->where('name', 'LIKE', '%'.$req->input('q').'%')->get();
        } else {
            $subjectsCollection = Subjects::with(['Course', 'Course.CourseType'])->get();
        }
        return response()->json($subjectsCollection);
    }

    public function store(Request $request){
        $subjectObject = $request->input('subject');
        Subjects::create($subjectObject);
        return response()->json(["status"=>"success", "message"=>"Thêm thành công môn học"]);
    }

    public function update($id, Request $request){
        $subjectObject = [
            "name" => $request->input('name'),
            "amount" => $request->input('amount'),
            "semester" => $request->input('semester'),
            "course_id" => $request->input('course_id'),
        ];
        Subjects::where('id', $id)->update($subjectObject);
        return response()->json(["status"=>"success", "message"=>"Sửa đổi thành công"]);
    }

    public function destroy($id){
        Subjects::where('id', $id)->delete();
        return response()->json(["status"=>"success", "message"=>"Đã xóa thành công"]);
    }
}
