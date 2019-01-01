<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'project_id',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
