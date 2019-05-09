<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classroom;

class ClassroomController extends Controller
{
    //
    public function index(Request $request){
        if($request->has('q')){
            $classroomCollections = Classroom::where('name', 'LIKE', '%'.$request->input('q').'%')->get();
        }else{
            $classroomCollections = Classroom::all();
        }

        return response()->json($classroomCollections);
    }

    public function store(Request $request){
        Classroom::create([
            "name" => $request->input('name'),
            "is_overtime" => $request->input('is_overtime'),
        ]);
        return response()->json(["status"=>"success", "message"=>"Thêm thành công"]);
    }

    public function update($id, Request $request){
        Classroom::where('id', $id)->update([
            "name" => $request->input('name'),
            "is_overtime" => $request->input('is_overtime'),
        ]);
        return response()->json(["status"=>"success", "message"=>"Sửa thành công"]);
    }
    
    public function destroy($id){
        Classroom::where('id', $id)->delete();
        return response()->json(["status"=>"success", "message"=>"Xóa thành công"]);
    }
}
