<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'user_id', 'project_name', 'project_description', 'project_deadline', 'project_image', 
    ];

    public function projectDetails() {
    	return $this->hasMany(ProjectDetail::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
