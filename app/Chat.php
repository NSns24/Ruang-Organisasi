<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $fillable = [
        'project_id', 'user_from', 'user_to', 'chat_message',
    ];

    public function getDate() {
    	return date('D, d M Y', strtotime($this->created_at));
    }

    public function getTime() {
    	return date('H:i', strtotime($this->created_at));
    }

    public function userFrom() {
    	return $this->belongsTo(User::class, 'user_from');
    }

    public function chatType() {
        return ($this->user_to == null) ? 'group' : $this->user_to;
    }
}
