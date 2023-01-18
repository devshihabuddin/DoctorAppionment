<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id','desc')->get();
        return view('Doctor.index',compact('doctors'));
    }

    public function changeStatus(Request $request){
        $doctors = Doctor::find($request->row_id);
        $doctors->status=$request->status;
        $doctors->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $departments =Department::all();   
        return view('Doctor.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'phone' => 'required|max:15',
            'fee'   => 'required',
            'status'=> 'required'
        ]);

        $data=[
            'department_id' => $request->department_id,
            'name' => $request->name,
            'phone'=> $request->phone,
            'fee'   => $request->fee,
            'status' => $request->status
        ];
       $doctors= Doctor::create($data);
       $notification = array('message' => 'Doctor Admitted!','alert-type' => 'success');
       return redirect()->back()->with($notification);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $doctor = Doctor::find($id);
        return view('Doctor.edit',compact('departments','doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'phone' => 'required|max:15',
            'fee'   => 'required',
        ]);

        $data = Doctor::find($id);
        $data->department_id=$request->department_id;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->fee = $request->fee;
        //Doctor::update($data)->where($id,$data->id);
        $data->save();
        $notification = array('message' => 'Doctor Updated!','alert-type' => 'success');
        return redirect()->route('doctors.index')->with($notification);
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::find($id)->delete();
        $notification = array('message' => 'Doctor Deleted!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
