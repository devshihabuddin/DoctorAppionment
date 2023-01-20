<?php

namespace App\Http\Controllers;

use App\Models\Appionment;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppionmentController extends Controller
{
    //

    public function index(){
        $departments = Department::all();
        return view('Appionment.index',compact('departments'));
    }

    //__doctor dropdown auto__//
    public function getDoctor(Request $request){
       $d_id   = $request->post('d_id');
       $doctor = Doctor::where('department_id',$d_id)->orderBy('name','asc')->get();
       $html   = '<option value="">select doctor</option>';
       foreach($doctor as $doc){
        $html.='<option value="'.$doc->id.'">'.$doc->name.'</option>';
       }
       echo $html;
    }

    //__getFee__//
    public function getFee(Request $request){
        $doctor_id = $request->post('doctor_id');
        //$doctors = DB::table('doctors')->where('id',$doctor_id)->get();
        $doctors = Doctor::where('id',$doctor_id)->get();
        $html = '';
        foreach($doctors as $doctor){
          //  $html.='<input class="form-control" value="'.$doctor->fee.'">';
           $html.='<option>'.$doctor->fee.'</option>';
        }       
        echo $html;
    }

    //__appionments data Store__//
    public function appionmentStore(Request $request){
        $data = Appointment::insert([
            'date'          => $request->date,
            'doctor_id'     => $request->doctor_id,
            'patient_name'  => $request->patient_name,
            'patient_phone' => $request->patient_phone,
            'total_fee'     => $request->totalFeeAmount,
            'paid_amount'   => $request->paid_amount,
        ]);
        return response()->json($data);
    }
}
