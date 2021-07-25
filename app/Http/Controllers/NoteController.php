<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{

    public function addNotes(int $contactId, Request $request):JsonResponse
    {
        $this->validate($request, [
            'note' => 'required',
        ]);

        if(empty($contactId)) {
            return response('Missing Company ID.', 406);
        }

        $note = new Note();
        $note->contact_id = $contactId;
        $note->note = $request->input('note');
        $result = $note->save();
        if( ! $result) {
            return response('Saving notes for the contact was unsuccessful.', 406);
        }

        return response()->json($note, 201);
    }
}
