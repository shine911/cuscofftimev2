<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offdays;
use Auth;
use App\Library\Event;
use PhpOffice\PhpSpreadsheet\IOFactory;
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

    public function show($id, Request $request){
        if($id == "me"){
            $offdays = Offdays::with('User', 'Class')->where('user_id', Auth::user()->id)->get();
            $events = array();
            foreach($offdays as $offday){
                array_push($events, $this->convertToEvent($offday));
            }
            return response()->json($events);
        }
        //Tính năng xuất file chỉ dành cho admin
        if($id=="export"){
            $_month = $request->input('month');
            if($_month!=''){
                $collection = Offdays::with(['User', 'Class'])->where('date', 'LIKE', $_month.'%')->get();
                $array = [];
                foreach($collection as $collect){
                    $inp = ["user_name" => $collect->User->name,
                            "class_name" => $collect->Class->name,
                            "time_start" => substr($collect->time_start,11,5),
                            "time_end" => substr($collect->time_end,11,5),
                            "reason" => $collect->reason,
                            "amount" => $collect->amount,
                            "date" => $collect->date];
                    array_push($array, $inp);
                }

                //Read
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                //$spreadsheet = new Spreadsheet();
                $spreadsheet = $reader->load("resource/SampleCalendar.xlsx");
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->fromArray($array, null, 'A2');

                $sheet->setTitle("Bang bao cao");

                /** DO NOT MODIFY. YOU DO OWN RISK */
                // Redirect output to a client’s web browser (Xlsx)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="'.$_month.'.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                ob_start();
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');
                $xlsData = ob_get_contents();
                ob_end_clean();
                $response =  array(
                    'op' => 'ok',
                    'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData)
                );
                return response()->json($response);
                /** DO NOT MODIFY. YOU DO OWN RISK */
            }
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

        $ngay = $request->input('date');
        // $timeBatDau = date('H:i',strtotime($request->input('time_start')));
        // $timeKetThuc = date('H:i',strtotime($request->input('time_end')));
        $timeStart = $request->input('time_start');
        $timeEnd = $request->input('time_end');
        $tu =  $ngay.' '.$timeStart.':00';
        $den = $ngay.' '.$timeEnd.':00';
        $update = [
            'class_id' => $request->input('class_id'),
            'time_start' => $tu,
            'time_end'=> $den,
            'reason' => $request->input('reason'),
            'amount' => $request->input('amount'),
            'date' => $ngay
        ];
        Offdays::where('id', $id)->where('user_id', Auth::user()->id)->update($update);

        return response()->json(["status"=>"success", "message"=>"Cập nhật thành công"]);
    }

    public function destroy($id){
        return $id;
    }
    public function convertToEvent($input){
        // $miscProp = array("reason" => $input->reason, "class_id"=>$input->Class->id, "classroom"=>$input->Class->name, "amount" => $input->amount, "id"=>$input->id);
        $miscProp = array("reason" => $input->reason, "classroom"=>$input->Class, "amount" => $input->amount, "id"=>$input->id);

        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }
}
