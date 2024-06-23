<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

        $result = 'Messaggio inviato con successo!';

        return response()->json($result);
    }
}
