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
        if($request->has("month")){
            $_month = $request->input('month');
        }
        if($_month != ''){
            $month = $_month;
        } else {
            $month =  date('Y-m');
        }

        $assignmentsCollection = Assignments::with(['Subject', 'Class', 'User'])->where('month', $month)->get();
        
        return response()->json($assignmentsCollection);
    }

    public function show($id, Request $request){
        $_month = $request->input('month');
        if($id=='export'){
            if($_month!=''){
                $phanCongCollection = Assignments::with(['User', 'Subject', 'Class'])->where('month', $_month)->get();
                $array = [];
                foreach($phanCongCollection as $phanCong){
                    $inp = ["TenCB" => $phanCong->User->name,
                            "tenMH" => $phanCong->Subject->name,
                            "TGBatDau" => $phanCong->time_start,
                            "TGKetThuc" => $phanCong->time_end,
                            "Thang" => $phanCong->month,
                            "Classroom" => $phanCong->Class->name,
                            "soTiet" => $phanCong->Subject->amount];
                    array_push($array, $inp);
                }

                //Read
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                //$spreadsheet = new Spreadsheet();
                $spreadsheet = $reader->load('resource/sample.xlsx');
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
        if($id=='me'){
            $assignmentsCollection = Assignments::with(['Subject', 'Class', 'User'])->where([['month', $_month], ["user_id", Auth::user()->id]])->get();
            return response()->json($assignmentsCollection);
        }
    }
}
