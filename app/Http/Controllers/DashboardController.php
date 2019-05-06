<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offdays;
use App\Library\Event;
use App\Assignments;
use App\User;
use App\CourseTypes;
use App\Courses;
use App\Classroom;
use App\Subjects;

class DashboardController extends Controller
{
    //
    public function show($name){
        if($name == 'chart'){
            $assignments = Assignments::with('Class', 'Subject')->get();
            $overTime = 0;
            $inTime = 0;
            foreach($assignments as $assignment){
                if($assignment->Class->isOvertime){
                    $overTime += $assignment->Subject->amount;
                } else {
                    $inTime += $assignment->Subject->amount;
                }
            }
            return response()->json([$inTime, $overTime]);
        }
        if($name == 'singlechart'){
            $user = User::with('Assignments', 'Assignments.Class', 'Assignments.Subject')->get();
            return response()->json($user);
        }
        if($name == 'summary'){
            $data = [];
            //$user = User->count();
            $user = User::count();
            $assignments = Assignments::count();
            $offdays = Offdays::count();
            $course_type = CourseTypes::count();
            $courses = Courses::count();
            $subjects = Subjects::count();
            $classroom = Classroom::count();
            $data = [
                "user" => $user,
                "assignments" => $assignments,
                "offdays" => $offdays,
                "course_type" => $course_type,
                "courses" => $courses,
                "subjects" => $subjects,
                "classroom" => $classroom
            ];
            return response()->json($data);
        }
        return dd("hello");
    }
    public function convertToEvent($input){
        $miscProp = array("reason" => $input->reason, "classroom"=>$input->Class->name);
        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }
}
