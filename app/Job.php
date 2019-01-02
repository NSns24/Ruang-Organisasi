<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'project_id', 'user_id', 'job_description', 'job_start', 'job_end', 'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
