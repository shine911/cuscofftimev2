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

    public function store(Request $request){
        Courses::create([
            "name" => $request->input('name'),
            "type_id" => $request->input('type_id')
        ]);
        return response()->json(["status"=>"success", "message"=>"Đã thêm chương trình"]);
    }

    public function update($id, Request $request){
        Courses::where('id', $id)->update([
            "name" => $request->input('name'),
            "type_id" => $request->input('type_id')
        ]);
        return response()->json(["status"=>"success", "message"=>"Đã sửa thành công"]);
    }

    public function destroy($id){
        Courses::where('id', $id)->delete();
        return response()->json(["status"=>"success", "message"=>"Đã xóa thành công"]);
    }
}
