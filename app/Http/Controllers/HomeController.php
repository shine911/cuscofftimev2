<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Event;
use App\Offdays;
use App\Assignments;
use App\Subjects;
use App\Classroom;
use App\CourseTypes;
use App\Courses;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //GetData From Model
        $month = date('Y-m');
        $offdays = Offdays::with('User', 'Class')->where('id', '<>', 1)->get();
        $phanCongCollection = Assignments::with(['Subjects', 'Classroom'])->where('month', $month)->get();
        $canBoCollection = User::with('Assignments', 'Assignments.Classroom', 'Assignments.Subjects')->where('id', '<>', 1)->get();

        //Xử lí từng người
        $canBoName = [];
        $trongGio = 0;
        $ngoaiGio = 0;
        $sumTrongGio = [];
        $sumNgoaiGio = [];
        $canBoData = [];
        foreach($canBoCollection as $canBo){
            array_push($canBoName, $canBo->name);
            foreach($canBo->Assignments as $phanCong){
                if($phanCong->Class->isOvertime != 1){
                    $trongGio+=$phanCong->Subject->amount;
                } else {
                    $ngoaiGio+=$phanCong->Subject->amount;
                }
            }
            array_push($sumTrongGio, $trongGio);
            array_push($sumNgoaiGio, $ngoaiGio);
            $trongGio = 0;
            $ngoaiGio = 0;
        }
        array_push($canBoData, $sumTrongGio, $sumNgoaiGio);

        $sumTrongGio = 0;
        $sumNgoaiGio = 0;
        foreach($phanCongCollection as $phanCong){
            if($phanCong->Class->isOvertime != 1){
                $sumTrongGio += $phanCong->Subject->amount;
            } else {
                $sumNgoaiGio += $phanCong->Subject->amount;
            }
        }

        $data['event'] = array();
        foreach($offdays as $offday){
            array_push($data['event'], $this->convertToEvent($offday));
        }
        
        $data['canBoName'] = $canBoName;
        $data['canBoData'] = $canBoData;
        $data['sumGio'] = [$sumTrongGio, $sumNgoaiGio];
        $data['summary'] = ["CanBo" => $canBoCollection->count(),
                            "NghiBu" => $offdays->count(),
                            "MonHoc" => Subjects::all()->count(),
                            "Lop" => Classroom::all()->count(),
                            "LoaiHinh" => CourseTypes::all()->count(),
                            "ChuongTrinh" => Courses::all()->count()
                        ];
        //Return view
        return view('home', $data);
    }

    public function convertToEvent($input){
        $miscProp = array("reason" => $input->reason, "classroom"=>$input->Class->name);
        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }

}
