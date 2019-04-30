<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offdays;
use Auth;
use App\Library\Event;
class CalendarController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(){
        $offdays = Offdays::with('User', 'Class')->where('user_id', Auth::user()->id)->get();
        $data['event'] = array();
        foreach($offdays as $offday){
            array_push($data['event'], $this->convertToEvent($offday));
        }
        return view('calendar', $data);
    }

    public function store(Request $request){
        $ngay = new \DateTime($request->input('date'));
        $timeBatDau = date('H:i',strtotime($request->input('time_start')));
        $timeKetThuc = date('H:i',strtotime($request->input('time_end')));
        $tu =  $ngay->format('Y-m-d').' '.$timeBatDau.':00';
        $den = $ngay->format('Y-m-d').' '.$timeKetThuc.':00';
        Offdays::create([
            'user_id' => Auth::user()->id,
            'class_id' => $request->input('class'),
            'time_start' => $tu,
            'time_end'=> $den,
            'reason' => $request->input('reason'),
            'amount' => $request->input('amount'),
            'date' => $ngay
        ]);
        return redirect()->back()->with('status', 'Đã thêm thành công');
    }
    
    public function convertToEvent($input){
        $miscProp = array("reason" => $input->reason, "class"=>$input->Class->name, "amount" => $input->amount);
        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }
}
