<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Validator;
class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointments.index');
    }
    //get the appointments of current user logged in
    public function allappointments(){
        $appointments = Appointment::getMyAppointments();

        return response()->json(['data' => $appointments]);
    }
    public function appointmentsRange(Request $request, $from, $to){
        $appointments = Appointment::between($from, $to);

        return response()->json(['data' => $appointments]);
    }
    public function averages(){
        $averages = Appointment::averages();
        return response()->json(['averages' => $averages]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|max:255',
            'status' => 'required',
            'date_to_attend' => 'required',
            'time_to_attend' => 'required',
            'contact_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => FALSE, "message" => "Campos incompletos"]);
        }
        else {
            $appointment = new Appointment();
            $appointment->subject = $request->input("subject");
            $appointment->status = $request->input("status");
            $appointment->date_to_attend = $request->input("date_to_attend");
            $appointment->time_to_attend = $request->input("time_to_attend");
            $appointment->contact_id = $request->input("contact_id");
            $appointment->save();
            $data = array(
                'appointment'   => $appointment,
                'success'       => TRUE,
                'message'       => 'Nueva cita agregada de manera correcta'
            );
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource as JSON.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        $appointment->contact;
        $appointment->contact->state;
        $appointment->contact->municipality;
        return response()->json(['appointment' => $appointment]);
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
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'status' => 'required',
            'date_to_attend' => 'required',
            'time_to_attend' => 'required',
            'contact_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => FALSE, "message" => "Campos incompletos"]);
        }
        else {
            $appointment = Appointment::find($id);
            $appointment->subject = $request->input("subject");
            $appointment->status = $request->input("status");
            $appointment->date_to_attend = $request->input("date_to_attend");
            $appointment->time_to_attend = $request->input("time_to_attend");
            $appointment->contact_id = $request->input("contact_id");
            $appointment->update();
            $data = array(
                'appointment'   => $appointment,
                'success'       => TRUE,
                'message'       => 'Cita actualizada de manera correcta'
            );
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        
        return response()->json(['success' => $appointment->delete()]);
    }
}
