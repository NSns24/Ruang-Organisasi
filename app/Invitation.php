<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'project_id', 'email',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function project() {
    	return $this->belongsTo(Project::class);
    }
}
