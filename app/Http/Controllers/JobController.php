<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Project;

class JobController extends Controller
{
    public function index($id) {
        if(Helper::checkProjectAccess($id, auth()->id())) {
            $project = Project::findOrFail($id);

            return view('jobs.index', compact('project'));
        }
        else {
            abort(404);
        }
    }
}
