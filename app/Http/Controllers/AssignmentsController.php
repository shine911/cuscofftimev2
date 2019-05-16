<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use App\Assignments;
use App\User;
use Auth;

class AssignmentsController extends Controller
{
    public function __construct(){
    }
    //
    public function index(Request $request){
        $month =  date('Y-m');
        if($request->has("month")){
            $_month = $request->input('month');
            if($_month != ''){
                $month = $_month;
            }
        }

        $startDay = date('Y-m-01', strtotime($month));
        $endDay = date('Y-m-t', strtotime($month));
        $assignmentsCollection = Assignments::with(['Subject', 'Class', 'User'])->whereBetween('time_start', [$startDay, $endDay])->get();       
        return response()->json($assignmentsCollection);
    }

    public function show($id, Request $request){
        $_month = $request->input('month');
        if($id=='export'){
            if($_month!=''){
                $startDay = date('Y-m-01', strtotime($_month));
                $endDay = date('Y-m-t', strtotime($_month));
                $phanCongCollection = Assignments::with(['User', 'Subject', 'Class'])->whereBetween('time_start', [$startDay, $endDay])->get();
                $array = [];
                $index = 1;
                foreach($phanCongCollection as $phanCong){
                    $inp = [
                            "STT" => $index,
                            "TGBatDau" => $phanCong->time_start,
                            "tenMH" => $phanCong->Subject->name,
                            "Classroom" => $phanCong->Class->name,
                            "SlotGio" => substr($phanCong->Class->name, 6, 1),
                            "TenCB" => $phanCong->User->name,
                            "SoGio" => $phanCong->Subject->amount
                        ];
                    $index++;
                    array_push($array, $inp);
                }

                /**
                 * Xử lí thống kê trong ngoài giờ từng người
                 */
                $users = Assignments::select('user_id', 'sub_id', 'class_id')
                ->with([
                    'User'=>function($q){
                        $q->select('id', 'name');
                    },
                    'Subject'=>function($q){
                        $q->select('id', 'amount');
                    },
                    'Class'
                ])
                ->get()
                ->groupBy('user_id');
                $user_array = [];
                $index = 1;
                foreach($users as $user){
                    $intime = 0;
                    $overtime = 0;
                    foreach($user as $subject){
                        if($subject->Class->is_overtime){
                            $overtime += $subject->Subject->amount;
                        } else {
                            $intime += $subject->Subject->amount;
                        }
                        
                    }
                    array_push($user_array, [
                        "stt" => $index,
                        "name" =>$user[0]->User->name,
                        "total" => $intime+$overtime,
                        "overtime" => $overtime?$intime:"0",
                        "intime" => $intime?$intime:"0",
                    ]);
                    $index++;
                }
                /** END */
                
                //Read
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                //$spreadsheet = new Spreadsheet();
                $spreadsheet = $reader->load('resource/sample.xlsx');
                $sheet = $spreadsheet->getActiveSheet();
                //Title
                $year = substr($_month, 0, 4);
                $month = substr($_month, 5, 2);
                $sheet->setCellValue('A5', "PHÂN CÔNG GIẢNG DẠY THÁNG ".$month." - ".$year);
                //TODO: Cần chỉnh sửa thêm dòng nếu vượt quá số dòng hiện có
                $sheet->fromArray($user_array, null, 'A20');
                //Thêm dòng tại đây
                if(count($array)>5){
                    $sheet->insertNewRowBefore(10, count($array)-5);
                }
                
                $sheet->fromArray($array, null, 'A10');

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
        
        if($id=='me'){
            $startDay = date('Y-m-01', strtotime($_month));
            $endDay = date('Y-m-t', strtotime($_month));
            $assignmentsCollection = Assignments::with(['Subject', 'Class', 'User'])
            ->where('user_id', Auth::user()->id)
            ->whereBetween('time_start', [$startDay, $endDay])
            ->get();
            return response()->json($assignmentsCollection);
        }

        /***
        if($id=='test'){
            $users = Assignments::select('user_id', 'sub_id', 'class_id')
            ->with([
                'User'=>function($q){
                    $q->select('id', 'name');
                },
                'Subject'=>function($q){
                    $q->select('id', 'amount');
                },
                'Class'
            ])
            ->get()
            ->groupBy('user_id');
            $user_array = [];
            foreach($users as $user){
                $intime = 0;
                $overtime = 0;
                foreach($user as $subject){
                    if($subject->Class->is_overtime){
                        $overtime += $subject->Subject->amount;
                    } else {
                        $intime += $subject->Subject->amount;
                    }
                }
                array_push($user_array, [
                    "name" =>$user[0]->User->name,
                    "intime" => $intime,
                    "overtime" => $overtime
                ]);
            }
            return response()->json($user_array);
        }
        ***/
    }

}
