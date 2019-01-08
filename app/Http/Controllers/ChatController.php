<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Project;
use App\Chat;
use App\ProjectDetail;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function index($id) 
    {   
        if(Helper::checkProjectAccess($id, auth()->id())) {
            $project = Project::findOrFail($id);
            $chats = Chat::where('project_id', $id)->where('user_to', 0)->orderBy('created_at', 'asc')->get();
            $friends  = ProjectDetail::where('project_id', $id)->where('user_id', '<>', auth()->id())->join('users', 'users.id', '=', 'project_details.user_id')->select('users.*')->get();

            return view('chat.index', compact('project', 'chats', 'friends'));
        }
        else {
            abort(404);
        }
    }

    //ajax request
    public function sendMessageGroup(Request $request) 
    {
        if(Helper::checkProjectAccess($request->project_id, auth()->id())) {
            $chat = new Chat;
            $chat->project_id = $request->project_id;
            $chat->user_from = auth()->id();
            $chat->chat_message = $request->chat;

            if($chat->save()) {
                $chat = $chat->where('id', $chat->id)->with('userFrom')->first();
                $chat->date = $chat->getDate();
                $chat->time = $chat->getTime();
                broadcast(new ChatEvent($chat))->toOthers();
                return $chat;
            }
        }
        
        return Helper::errorProcessJson();
    }

    //ajax request
    public function getMessagePersonal(Request $request) 
    {
        if(Helper::checkProjectAccess($request->project_id, auth()->id())) {
            $chatTo = Chat::where('project_id', $request->project_id)->where('user_to', $request->user_id)->where('user_from', auth()->id())->get();
            $chatFrom = Chat::where('project_id', $request->project_id)->where('user_to', auth()->id())->where('user_from', $request->user_id)->get();

            $chats = $chatTo->merge($chatFrom)->sortBy('created_at');
            return view('layout.chat', compact('chats'));
        }
        
        return Helper::errorProcessJson();
    }

    //ajax request
    public function sendMessagePersonal(Request $request) 
    {
        if(Helper::checkProjectAccess($request->project_id, auth()->id()) && $request->user_to != auth()->id()) {
            $chat = new Chat;
            $chat->project_id = $request->project_id;
            $chat->user_from = auth()->id();
            $chat->user_to = $request->user_to;
            $chat->chat_message = $request->chat;

            if($chat->save()) {
                $chat = $chat->where('id', $chat->id)->with('userFrom')->first();
                $chat->date = $chat->getDate();
                $chat->time = $chat->getTime();
                broadcast(new ChatEvent($chat))->toOthers();
                return $chat;
            }
        }

        return Helper::errorProcessJson();
    }
}
