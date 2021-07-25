<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{

    public function all(): JsonResponse
    {
        return response()->json(Contact::paginate(10));
    }

    public function get(int $id): JsonResponse
    {
        return response()->json(Contact::findOrFail($id));
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'company_id' => 'required|integer',
            'name' => 'required',
            'tel' => 'numeric|min:100000|max:999999',
            'email' => 'required|email'
        ]);

        $contact = Contact::create($request->all());

        if( ! $contact->id){
            return  response()->json('Creating the contact was unsuccessful.', 406);
        }

        return response()->json($contact, 201);
    }

    public function storeMultipleContactsForACompany(int $companyId, Request $request):JsonResponse
    {

        $contacts = json_decode($request->input('contacts'), true);
        if(empty($contacts) OR !is_array($contacts)) {
            return response()->json('Missing contacts or incorrect data structure.', 406);
        }

        $newContact = [];
        foreach($contacts as $key => $contact) {

            if(empty($contact['name']) OR empty($contact['email']) OR empty($contact['tel'])) {
                continue;
            }

            $newContact[$key]['company_id'] = $companyId;
            $newContact[$key]['name'] = $contact['name'];
            $newContact[$key]['email'] = $contact['email'];
            $newContact[$key]['tel'] = $contact['tel'];
            $newContact[$key]['created_at'] = date('Y-m-d G:i:s');
        }
        $result = Contact::insert($newContact);
        if( ! $result) {
            return  response()->json('Adding multiple contacts for a company was unsuccessful.', 406);
        }

        return response()->json("The contacts have been saved successfully.", 201);

    }

    public function edit(int $companyId, Request $request):JsonResponse
    {
        $contact = Contact::findOrFail($companyId);
        $contact->company_id =  $request->input('company_id');
        $contact->name =  $request->input('name');
        $contact->email =  $request->input('email');
        $contact->tel =  $request->input('tel');
        $contact->updated_at =  date('Y-m-d G:i:s');
        $result = $contact->save();
        if( ! $result) {
            return  response()->json('Editing the contact was unsuccessful.', 406);
        }

        return response()->json($contact, 200);
    }

    public function listByCompanyId(int $companyId):JsonResponse
    {
        if(empty($companyId)) {
            return  response()->json('Missing Company ID.', 406);
        }

        $contacts = Contact::where('company_id', $companyId)->get();
        if($contacts->isEmpty()) {
            return  response()->json('There are no contacts for the company.', 404);
        }
        return response()->json($contacts);
    }

    public function searchByContactName(string $name):JsonResponse
    {
        if(empty($name)) {
            return  response()->json('The contact name to search by is missing.', 406);
        }

        $result = Contact::where('name', 'like', '%' . $name . '%')->get();
        if($result->isEmpty()) {
            return  response()->json("There are no contacts for the for the contact name: $name", 404);
        }
        return response()->json($result);
    }

    public function searchByCompanyName(string $companyName):JsonResponse
    {
        if(empty($companyName)) {
            return response()->json('The company name to search by is missing.', 406);
        }

        $result = Contact::where('companies.name', 'like', '%' . $companyName . '%')
            ->leftJoin('companies', 'companies.id', '=', 'contacts.company_id')
            ->get();

        if($result->isEmpty()) {
            return response()->json("There are no contacts for the for the company: $companyName", 404);
        }
        return response()->json($result);
    }
}
