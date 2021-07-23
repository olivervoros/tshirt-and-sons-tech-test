<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{

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
}
