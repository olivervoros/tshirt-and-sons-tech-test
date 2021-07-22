<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{

    public function all()
    {
        return Contact::paginate(request()->all());
    }

    public function get($id)
    {
        return response()->json(Contact::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'company_id' => 'required|integer',
            'name' => 'required',
            'tel' => 'numeric|min:100000|max:999999',
            'email' => 'required|email'
        ]);

        $contact = Contact::create($request->all());

        return response()->json($contact, 201);
    }

    public function storeMultipleContactsForACompany($companyId)
    {

    }

    public function addNotes($contactId)
    {

    }

    public function edit($id, Request $request)
    {
        $contact = Contact::findOrFail($id);
        $contact->company_id =  $request->input('company_id');
        $contact->name =  $request->input('name');
        $contact->email =  $request->input('email');
        $contact->tel =  $request->input('tel');
        $contact->updated_at =  date('Y-m-d G:i:s');
        $contact->save();

        return response()->json($contact, 200);
    }

    public function listByCompanyId($companyId)
    {
        return response()->json(Contact::where('company_id', $companyId));
    }

    public function searchByContactName($name)
    {
        //return response()->json(Contact::where('company_id', $companyId));
    }

    public function searchByCompanyName($companyName)
    {
        //return response()->json(Contact::where('company_id', $companyId));
    }
}
