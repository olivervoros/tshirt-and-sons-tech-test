<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Note;

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

    // TODO: move this the notecontroller...
    public function addNotes($contactId, Request $request)
    {
        $this->validate($request, [
            'note' => 'required',
        ]);

        $note = new Note();
        $note->contact_id = $contactId;
        $note->note = $request->input('note');

        return response()->json($note, 201);
    }

    public function edit($companyId, Request $request)
    {
        $contact = Contact::findOrFail($companyId);
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
        return response()->json(Contact::where('company_id', $companyId)->get());
    }

    public function searchByContactName($name)
    {
        return Contact::where('name', 'like', '%' . $name . '%')->get();
    }

    public function searchByCompanyName($companyName)
    {
        return Contact::where('companies.name', 'like', '%' . $companyName . '%')
            ->leftJoin('companies', 'companies.id', '=', 'contacts.company_id')
            ->get();
    }
}
