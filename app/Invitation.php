<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'project_id', 'user_from', 'user_to', 'status',
    ];

    public function userFrom() {
    	return $this->belongsTo(User::class, 'user_from');
    }

    public function project() {
    	return $this->belongsTo(Project::class, 'project_id');
    }

    public function userTo() {
        return $this->belongsTo(User::class, 'user_to');
    }
}
