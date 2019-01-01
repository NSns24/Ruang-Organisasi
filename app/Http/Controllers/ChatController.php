<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Project;
use App\Chat;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        if(Helper::checkProjectAccess($id, auth()->id())) {
            $project = Project::findOrFail($id);
            $chats = Chat::where('project_id', $id)->whereNull('user_to')->orderBy('created_at', 'asc')->get();

            return view('chat.index', compact('project', 'chats'));
        }
        else {
            abort(404);
        }
    }

    //ajax request
    public function sendMessageGroup(Request $request) {
        if(Helper::checkProjectAccess($request->project_id, auth()->id())) {
            $chat = new Chat;
            $chat->project_id = $request->project_id;
            $chat->user_from = auth()->id();
            $chat->chat_message = $request->chat;

            if($chat->save()) {
                $chat = $chat->where('id', $chat->id)->with('userFrom')->first();
                $chat->date = $chat->getDate();
                $chat->time = $chat->getTime();
                $chat->user_to = 0;
                broadcast(new ChatEvent($chat));
                return $chat;
            }
        }
        
        return Helper::errorProcessJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
