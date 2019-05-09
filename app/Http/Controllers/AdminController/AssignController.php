<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Assignments;
class AssignController extends Controller
{
    //
    public function index(){
        $assignmentsCollection = Assignments::with(['Subject', 'Subject.Course', 'Subject.Course.CourseType', 'Class', 'User'])->get();
        return response()->json($assignmentsCollection);
    }

    public function store(Request $request){
        $user_id = $request->input('user_id');
        $sub_id = $request->input('sub_id');
        $time_start = $request->input('time_start');
        $time_end = $request->input('time_end');
        $month = $request->input('month');
        $class_id = $request->input('class_id');

        Assignments::create([
            'user_id' => $request->input('user_id'),
            'sub_id' => $request->input('sub_id'),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'month' => $request->input('month'),
            'class_id' => $request->input('class_id')
        ]);
        return response()->json(["status"=>"success", "message"=>"Thêm thành công"]);
    }

    public function update($id, Request $request){
        Assignments::where('id', $id)->update([
            'user_id' => $request->input('user_id'),
            'sub_id' => $request->input('sub_id'),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'month' => $request->input('month'),
            'class_id' => $request->input('class_id')
        ]);
        return response()->json(["status"=>"success", "message"=>"Sửa thành công"]);
    }

    public function destroy($id){
        Assignments::where('id', $id)->delete();
        return response()->json(["status"=>"success", "message"=>"Đã xóa thành công"]);
    }
}
