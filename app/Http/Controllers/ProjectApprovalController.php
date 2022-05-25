<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachment;
use App\Project;
use App\Contact;

class ProjectApprovalController extends Controller
{
    //
    public function index(){

        $projects = Project::with('attachment', 'contact')->get();
        //dd($projects);
        return view('projectApproval.index',['projects' => $projects]);
    }
    public function rejProject($id){
        Project::Where('id', $id )->update(['status' => 'Rejected']);
        return back();
    }
    public function approveProject($id){
        Project::Where('id', $id )->update(['status' => 'Approved']);
        return back();
    }
}
