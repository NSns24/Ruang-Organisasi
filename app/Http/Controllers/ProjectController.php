<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectDetail;
use App\Invitation;
use App\User;
use App\Helpers\Helper;
use App\Events\AddMemberEvent;
use App\Events\InvitationRespondEvent;

class ProjectController extends Controller
{
    public function index()
    {
        $ownProjects = Project::where('user_id', auth()->id())->get();

        $otherProjects = Project::where('project_details.user_id', auth()->id())->join('project_details', 'projects.id', '=', 'project_details.project_id')->select('projects.*')->get();

        $projects = $ownProjects->merge($otherProjects)->sort(function($a, $b) {
            if($a->project_deadline <= date('Y-m-d')) {
                return -1;
            }

            if($b->project_deadline <= date('Y-m-d')) {
                return -1;
            }

            return $a->project_deadline <= $b->project_deadline;
        });

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

        $countCurrProject = Project::where('project_deadline', '>', date('Y-m-d'))->where('user_id', auth()->id())->count();

        if($countCurrProject != 0) {
            return back()->withErrors([
                'currProject' => 'You can only have one undergoing project'
            ])->withInput();
        }

        $request['user_id'] = auth()->id();
        
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

        if(Helper::checkProjectAccess($id, auth()->id())) {
            return view('home.index', compact('project'));
        }
        else {
            abort(404);
        }
    }

    //ajax request
    public function updateProgress(Request $request) {
        $project = Project::findOrFail($request->project_id);

        if(!Helper::checkProjectOwner($request->project_id, auth()->id())) {
            return Helper::errorProcessJson();
        }

        if($project) {
            $project->project_progress = $request->progress;

            if($project->save()) {
                return session()->flash('updateProgress', 1);
            }
        }

        return Helper::errorProcessJson();
    }

    public function newMember(Request $request) {
        if(!Helper::checkProjectOwner($request->project_id, auth()->id())) {
            return Helper::errorProjectAccess();
        }

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return back()->withErrors('Email not found')->withInput();
        }
        else if($user->id == auth()->id()) {
            return back()->withErrors('You can\'t send invitation to your own email')->withInput();
        }
        else {
            $projectDetail = ProjectDetail::where('user_id', $user->id)->where('project_id', $request->project_id)->first();

            if($projectDetail) {
                return back()->withErrors('This user has become a member in your project');
            }
        }

        $invitation = Invitation::where('project_id', $request->project_id)->where('user_from', auth()->id())->where('user_to', $user->id)->with('project')->with('userFrom')->first();

        if(!$invitation) {
            $invitation = new Invitation;
            $invitation->project_id = $request->project_id;
            $invitation->user_from = auth()->id();
            $invitation->user_to = $user->id;

            if($invitation->save()) {
                $invitation = $invitation->where('id', $invitation->id)->with('project')->with('userFrom')->first();
                broadcast(new AddMemberEvent($invitation));
                return back()->with('success', 'Invitation has been sent. Please wait for your friend to accept it'); 
            }
        }
        else {
            broadcast(new AddMemberEvent($invitation));
            return back()->with('success', 'Invitation has been sent again'); 
        }

        return Helper::errorProcess();
    }

    //ajax request
    public function invitation(Request $request) {
        if($request->choose == 1) {
            $projectDetail = new ProjectDetail;
            $projectDetail->project_id = $request->project_id;
            $projectDetail->user_id = auth()->id();

            if($projectDetail->save()) {
                $invitation = Invitation::where('id', $request->invitation_id)->with('project')->with('userTo')->first();
                $invitation->status = 1;

                if($invitation->save()) {
                    broadcast(new InvitationRespondEvent($invitation));
                    return response()->json(null, 200);
                }
            }
        }
        else if($request->choose == 0) {
            $invitation = Invitation::where('id', $request->invitation_id)->with('project')->with('userTo')->first();
            $invitation->status = 2;

            if($invitation->save()) {
                broadcast(new InvitationRespondEvent($invitation));
                return response()->json(null, 200);
            }
        }

        return Helper::errorProcessJson();
    }

    //ajax request
    public function deleteInvitation(Request $request) {
        Invitation::destroy($request->invitation_id);
    }

    public function deleteProject($id) {
        if(!Helper::checkProjectOwner($id, auth()->id())) {
            return Helper::errorProjectAccess();
        }

        Project::destroy($id);

        return redirect('project')->with('success', 'Delete Project Success'); 
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
