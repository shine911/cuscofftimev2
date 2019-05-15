<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offdays;
use App\User;
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
        $offdays = Offdays::with('User', 'Assignments', 'Assignments.Class', 'Assignments.Subject')->get();
        //$offdays = Offdays::with('User', 'Class')->where('id', '<>', 1)->get();
        $event = array();
        foreach($offdays as $offday){
            array_push($event, $this->convertToEvent($offday));
        }
        return response()->json($event);
    }

    public function show($id, Request $request){
        if($id == "me"){
            $offdays = Offdays::with('User', 'Assignments', 'Assignments.Class', 'Assignments.Subject')->where('user_id', Auth::user()->id)->get();
            $events = array();
            foreach($offdays as $offday){
                array_push($events, $this->convertToEvent($offday));
            }
            return response()->json($events);
        }
        //Tính năng xuất file chỉ dành cho admin
        //TODO: Fix here to work with calendar
        if($id=="export"){
            if(Auth::user()->can('admin')){
                $_month = $request->input('month');
                if($_month!=''){
                    $collection = Offdays::with([
                        'User',
                        'Assignments'=>function($q){
                        }, 
                        'Assignments.Class', 
                        'Assignments.Subject'
                        ])
                        ->where('date', 'LIKE', $_month.'%')
                        ->get()
                        ->groupBy(['user_id', 'assign_id']);
                    
                    //$array = $collection;
                    
                    $spread = [];
                    foreach($collection as $key=>$user){
                        $array = [];
                        $index = 1;
                        foreach($user as $subjects){
                            $amount = 0;
                            foreach($subjects as $sub){
                                $amount += $sub->Assignments->Subject->amount;
                            }
                            $inp = [
                                "index"=>$index,
                                "username"=>$subjects[0]->User->name,
                                "classname"=>$subjects[0]->Assignments->Class->name,
                                "subjectname"=>$subjects[0]->Assignments->Subject->name,
                                "amount" => $amount,
                            ];
                            $index++;
                            array_push($array, $inp);
                        }
                        array_unshift($spread, $array);
                    }
                    //TESTING JSON HERE
                    //return response()->json($array);
                    //END TESTING
                    
                    //Read
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $spreadsheet = $reader->load("resource/SampleCalendar.xlsx");

                    //$spreadsheet = new Spreadsheet();
                    $index = 1;
                    foreach($spread as $inp){
                        $clonedWorksheet = clone $spreadsheet->getSheet(0);
                        $clonedWorksheet->setTitle($inp[0]['username']);
                        $spreadsheet->addSheet($clonedWorksheet);
                        $sheet = $spreadsheet->getSheet($index);
                        if(count($inp)>2){
                            $sheet->insertNewRowBefore(8, count($inp)-2);
                        }
                        $sheet->fromArray($inp, null, 'A8');
                        $sheet->setCellValue('A6', "Tháng ".date("m Y", strtotime($_month)));
                        $index++;
                    }
                    $spreadsheet->removeSheetByIndex(0);

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
            'assign_id' => $request->input('assign_id'),
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
            'assign_id' => $request->input('assign_id'),
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
        $miscProp = array(
            "reason" => $input->reason,
            "assignment" => $input->Assignments,
            "amount" => $input->amount, "id"=>$input->id);

        $array = array("title"=> $input->User->name, "start"=>$input->time_start, "end"=>$input->time_end, "properties"=>$miscProp);
        $event = new Event($array, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $event->toArray();
    }
}
