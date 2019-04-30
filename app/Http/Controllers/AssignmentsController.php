<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use App\Assignments;

class AssignmentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function index(Request $request){
        $_month = $request->input('thang');
        if($_month != ''){
            $thang = $_month;
        } else {
            $thang =  date('Y-m');
        }

        $phanCongCollection = Assignments::with(['Subjects', 'Classroom', 'CanBo'])->where('month', $thang)->get();
        $data['phanCongCollection'] = $phanCongCollection;
        $data['now'] = $thang;
        return view('assignments', $data);
    }

    public function show($id, Request $request){
        $_month = $request->input('month');
        if($id=='export'){
            if($_month!=''){
                $phanCongCollection = Assignments::with(['User', 'Subjects', 'Classroom'])->where('month', $_month)->get();
                $array = [];
                foreach($phanCongCollection as $phanCong){
                    $inp = ["TenCB" => $phanCong->User->name,
                            "tenMH" => $phanCong->Subjects->name,
                            "TGBatDau" => $phanCong->time_start,
                            "TGKetThuc" => $phanCong->time_end,
                            "Thang" => $phanCong->month,
                            "Classroom" => $phanCong->Classroom->name,
                            "soTiet" => $phanCong->Subjects->amount];
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

                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');
                exit;
                echo "<script>window.close();</script>";
                /** DO NOT MODIFY. YOU DO OWN RISK */
            }
        }
    }
}
