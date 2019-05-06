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
        $offdays = Offdays::with('User', 'Class')->get();
        //$offdays = Offdays::with('User', 'Class')->where('id', '<>', 1)->get();
        $event = array();
        foreach($offdays as $offday){
            array_push($event, $this->convertToEvent($offday));
        }
        return response()->json($event);
    }

    public function show($id){
        if($id == "me"){
            $offdays = Offdays::with('User', 'Class')->where('user_id', Auth::user()->id)->get();
            $events = array();
            foreach($offdays as $offday){
                array_push($events, $this->convertToEvent($offday));
            }
            return response()->json($events);
        }

    }

    public function store(Request $request){
        $ngay = $request->input('date');
        // $timeBatDau = date('H:i',strtotime($request->input('time_start')));
        // $timeKetThuc = date('H:i',strtotime($request->input('time_end')));
        $timeStart = $request->input('time_start');
        $timeEnd = $request->input('time_end');
        $tu =  $ngay.' '.$timeStart.':00';
        $den = $ngay.' '.$timeEnd.':00';
        Offdays::create([
            'user_id' => Auth::user()->id,
            'class_id' => $request->input('class_id'),
            'time_start' => $tu,
            'time_end'=> $den,
            'reason' => $request->input('reason'),
            'amount' => $request->input('amount'),
            'date' => $ngay
        ]);
        return response()->json([
            "status" =>"success",
            "message" => "Đã thêm thành công"
        ]);
    }
    
    public function update($id, Request $request){
        $ngay = new \DateTime($request->input('date'));
        // $timeBatDau = date('H:i',strtotime($request->input('time_start')));
        // $timeKetThuc = date('H:i',strtotime($request->input('time_end')));
        $timeStart = $request->input('time_start');
        $timeEnd = $request->input('time_start');
        $tu =  $ngay->format('Y-m-d').' '.$timeStart.':00';
        $den = $ngay->format('Y-m-d').' '.$timeEnd.':00';
        $update = [
            'class_id' => $request->input('class'),
            'time_start' => $tu,
            'time_end' => $den,
            'reason' => $request->input('reason'),
            'amount' => $request->input('amount'),
            'date' => $ngay
        ];
        Offdays::where('id', $id)->where('user_id', Auth::user()->id)->update($update);

        return redirect()->back()->with('status', 'Chỉnh sửa thành công');
    }

    public function destroy($id){
        return $id;
    }
    public function convertToEvent($input){
        $miscProp = array("reason" => $input->reason, "class"=>$input->Class->name, "amount" => $input->amount, "id"=>$input->id);
        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }
}
