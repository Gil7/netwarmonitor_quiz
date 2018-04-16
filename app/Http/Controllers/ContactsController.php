<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.index');
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
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'municipality' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => FALSE, "message" => "Campos incompletos"]);
        }
        else {
            $contact = new Contact();
            $contact->name = $request->input("name");
            $contact->lastname = $request->input("lastname");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->municipality_id = $request->input("municipality");
            $contact->save();
            $data = array(
                'contact'   => $contact,
                'success'       => TRUE,
                'message'       => 'Contacto agregado de manera correcta'
            );
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        $contact->appointments;
        $contact->state;
        $contact->municipality->state;
        return response()->json(['success' => TRUE, 'contact' => $contact]);
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
            'name' => 'required|max:255',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'municipality' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => FALSE, "message" => "Campos incompletos"]);
        }
        else {
            $contact = Contact::findOrFail($id);
            $contact->name = $request->input("name");
            $contact->lastname = $request->input("lastname");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->municipality_id = $request->input("municipality");
            $contact->update();
            $data = array(
                'contact'       => $contact,
                'success'       => TRUE,
                'message'       => 'Contacto actualizado de manera correcta'
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
        $contact =  Contact::find($id);

        return response()->json(['success' => $contact->delete()] );
    }
}
