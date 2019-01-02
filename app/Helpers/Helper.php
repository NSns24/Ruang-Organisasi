<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Validator;
use App\Project;
use App\ProjectDetail;

class Helper
{
    private static $messages = [
        'email.required' => 'Email must be filled',
        'email.email' => 'Email must be in email format',
        'email.unique' => 'Email has been used',
        'name.required' => 'Name must be filled',
        'name.between' => 'Name must be between 4 to 30 characters',
        'password.required' => 'Password must be filled',
        'password.between' => 'Password must be between 6 to 10 characters', 
        'confirm_password.same' => 'Confirm Password did not match',
        'contact_number.required' => 'Contact Number must be filled',
        'contact_number.digits_between'=> 'Format must be number, 10 to 15 digits',
        'profile_picture.required' => 'Profile Picture must be uploaded',
        'profile_picture.image' => 'Profile Picture must be an image',

        'project_name.required' => 'Project Name must be filled',
        'project_name.between' => 'Project Name must be between 5 to 50 characters',
        'project_deadline.required' => 'Project Deadline must be filled',
        'project_deadline.date' => 'Project Deadline must be in date format',
        'project_deadline.date_format' => 'Project Deadline has wrong date format',
        'project_deadline.after' => 'Project Deadline must be greater than today',
        'project_image.required' => 'Project Image must be uploaded',
        'project_image.image' => 'Project Image must be an image',

        'job_description.required' => 'Job Description must be filled',
        'job_start.required' => 'Job Start must be filled',
        'job_start.date' => 'Job Start must be in date format',
        'job_start.date_format' => 'Job Start has wrong date format',
        'job_start.after_or_equal' => 'Job Start must be greater than or equal to today',
        'job_start.before' => 'Job Start must be before project deadline',
        'job_end.required' => 'Job End must be filled',
        'job_end.date' => 'Job End must be in date format',
        'job_end.date_format' => 'Job End has wrong date format',
        'job_end.after_or_equal' => 'Job End must be greater than or equal to Job Start',
        'job_end.before' => 'Job End must be before project deadline',
        'assign_to.required' => 'Assign To must be choosed',
    ];
    
    public static function validate(Request $request, Array $rules) {
        $validator = Validator::make($request->all(), $rules, self::$messages);

        return $validator;
    }

    public static function errorProcess() {
        return back()->with('error', 'Error while processing data');
    }

    public static function errorProcessJson() {
        return response()->json(null, 404);
    }

    public static function checkProjectOwner($project_id, $user_id) {
        $project = Project::where('user_id', $user_id)->where('id', $project_id)->count();

        if($project == 0) {
            return false;
        }
        else {
            return true;
        }
    }

    public static function checkProjectAccess($project_id, $user_id) {
        $ownProject = Project::where('user_id', $user_id)->where('id', $project_id)->count();

        $otherProject = ProjectDetail::where('user_id', $user_id)->where('project_id', $project_id)->count();

        if($ownProject == 0 && $otherProject == 0) {
            return false;
        }
        else {
            return true;
        }
    }

    public static function errorProjectAccess() {
        return back()->with('error', 'Wrong Project');
    }
}