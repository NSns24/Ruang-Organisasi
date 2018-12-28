<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectDetail;
use App\Invitation;
use App\User;
use App\Helpers\Helper;
use App\Events\WebSocketEvent;

class ProjectController extends Controller
{
    public function index()
    {
        $ownProjects = Project::where('user_id', session('currentUser')['id'])->get();

        $otherProjects = ProjectDetail::where('project_details.user_id', session('currentUser')['id'])->join('projects', 'projects.id', '=', 'project_details.project_id')->select('projects.*')->get();

        $projects = $ownProjects->union($otherProjects)->sortByDesc('project_deadline');

        return view('projectList.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $rules = [
            'project_name' => 'required|between:5,50',
            'project_deadline' => 'required|date|date_format:Y-m-d|after:today',
            'project_image' => 'required|image'
        ];

        $validator = Helper::validate($request, $rules);
        
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $countCurrProject = Project::where('project_deadline', '>', date('Y-m-d'))->count();

        if($countCurrProject != 0) {
            return back()->withErrors([
                'currProject' => 'You can only have one undergoing project'
            ])->withInput();
        }

        $request['user_id'] = session('currentUser')['id'];
        
        $project = Project::create($request->all());

        if($project->exists) {
            $filename = $project->id.'_'.$project->user_id.'_'.$project->project_name.'.'.$request->file('project_image')->getClientOriginalExtension();
            $request->file('project_image')->move(public_path().'/assets/image/project/', $filename);
            $project->project_image = $filename;
            
            if($project->save()) {
                return back()->with('success', 'New Project added successfully');
            }
        }

        return Helper::errorProcess();
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        session(['currProjectID' => $id]);

        return view('home.index', compact('project'));
    }

    public function updateProgress(Request $request) {
        $project = Project::findOrFail($request->project_id);
        
        if($project) {
            $project->project_progress = $request->progress;

            if($project->save()) {
                return session()->flash('updateProgress', 1);
            }
        }

        return Helper::errorProcessJson();
    }

    public function newMember(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return back()->withErrors('Email not found')->withInput();
        }
        else if($user->id == session('currentUser')['id']) {
            return back()->withErrors('You can\'t send invitation to your own email')->withInput();
        }

        $invitation = new Invitation;
        $invitation->user_id = session('currentUser')['id'];
        $invitation->project_id = session('currProjectID');
        $invitation->email = $request->email;

        if($invitation->save()) {
            broadcast(new AddMemberEvent($invitation->user_id));
            return back()->with('success', 'Invitation has been sent. Please wait for your friend to accept it'); 
        }

        return Helper::errorProcess();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
