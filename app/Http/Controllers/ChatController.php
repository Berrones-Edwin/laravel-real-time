<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\MessageSend;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request){

        $rules =[
            'message' => 'required'
        ];

        $request->validate($rules);

        broadcast(new MessageSend($request->user(),$request->message));

        return response()->json(['message'=>'ok']);

    }
}
