<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected $fillable = [
        'project_id', 'name', 'description', 'video',
    ];
}
