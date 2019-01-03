<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Project;
use App\ProjectDetail;
use App\Job;

class JobController extends Controller
{
    public function index($id) {
        if(Helper::checkProjectAccess($id, auth()->id())) {
            $project = Project::findOrFail($id);
            $friends = ProjectDetail::where('project_id', $id)->get();
            
            if($project->user_id == auth()->id()) {
                $jobs = Job::where('project_id', $id)->get();
            }
            else {
                $jobs = Job::where('project_id', $id)->where('user_id', auth()->id())->get();
            }

            $events = collect();

            foreach($jobs as $job) {
                $temp = [
                    'title' => $job->job_description,
                    'start' => $job->job_start,
                    'end' => $job->job_end,
                    'description' => 'Assigned to '.$job->user->name,
                    'job' => $job->id,
                    'user' => $job->user_id
                ];

                $events->push($temp);
            }

            $events->push([
                'title' => 'Project Deadline',
                'start' => $project->project_deadline,
                'description' => 'Your Deadline Project',
                'rendering' => 'background',
                'color' => '#ff9f89',
                'overlap' => false,
            ]);
                
            return view('jobs.index', compact('project', 'friends', 'events'));
        }
        else {
            abort(404);
        }
    }

    public function store(Request $request) {
        $project = Project::findOrFail($request->project_id);

        $rules = [
            'job_description' => 'required',
            'job_start' => 'required|date|date_format:Y-m-d|after_or_equal:today|before:'.$project->project_deadline,
            'job_end' => 'required|date|date_format:Y-m-d|after_or_equal:job_start|before:'.$project->project_deadline,
            'assign_to' => 'required'
        ];

        $validator = Helper::validate($request, $rules);
        
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if(!Helper::checkProjectOwner($request->project_id, auth()->id())) {
            return Helper::errorProjectAccess();
        }
        else if(Helper::checkProjectAccess($request->project_id, $request->assign_to)) {
            $request['user_id'] = $request->assign_to;

            $job = Job::create($request->all());

            if($job->exists) {
                return back()->with('success', 'Assign Job Success');
            }
        }

        return Helper::errorProcess();
    }

    //ajax request
    public function changeSchedule(Request $request) {
        if(!Helper::checkProjectOwner($request->project_id, auth()->id())) {
            return Helper::errorProcessJson();
        }
        else if(Helper::checkProjectAccess($request->project_id, $request->user_id)) {
            $job = Job::findOrFail($request->job_id);
            $job->job_start = $request->job_start;
            $job->job_end = $request->job_end;

            if($job->save()) {
                return response()->json(null, 200);
            }
        }

        return Helper::errorProcessJson();
    }

    //ajax request
    public function deleteJob(Request $request) {
        if(!Helper::checkProjectOwner($request->project_id, auth()->id())) {
            return Helper::errorProcessJson();
        }
        
        Job::destroy($request->job_id);
    }
}
