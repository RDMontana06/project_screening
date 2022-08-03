<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Project;
use App\Contact;
use Alert;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectIndex(Request $request)
    {
        // dd($request);
        $projects = Project::with('attachment', 'contact')->get();
        return view($request->path().'.index', ['projects' => $projects]);
    }
    public function projScrenningSave(Request $request)
    {
        $this->validate($request, [
            'project_name' => 'unique:projects|required',
            'project_type' => 'required',
            // 'ref_code' => 'required',
            'location' => 'required',
            'contactNum' => 'required',
            'contactPerson' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'type' =>  'required',
            'approved_budget' => 'required',
            'remarks' => 'required',
            'file' => 'required',
        ]);

        $refCode = 'PSF';
        $project = new Project;
        $project->project_name = $request->project_name;
        $project->project_type = $request->project_type;
        $latestProj = Project::orderBy('created_at', 'DESC')->first();
        $project->ref_code = (!$latestProj) ? $refCode . '-' . str_pad(1, 10, "0", STR_PAD_LEFT) : $refCode . '-' . str_pad($latestProj->id + 1, 10, "0", STR_PAD_LEFT);
        $project->location = $request->location;
        $project->company_name = $request->company_name;
        $project->address = $request->address;
        $project->type = $request->type;
        $project->approved_budget = $request->approved_budget;
        $project->remarks = $request->remarks;
        $project->prepared_by = auth()->user()->id;
        $project->status = 'Pending';
        $project->save();

        // Save multiple contact
        $contact_number = $request->contactNum;
        foreach ($request->contactPerson as $key => $contactPerson) {
            $contact = new Contact;
            $contact->contact_name = $contactPerson;
            $contact->contact_number = $contact_number[$key];
            $contact->project_id = $project->id;
            $contact->save();
        }
        //Save Multiple File
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->getClientOriginalName();
                $name = time() . '-' . $path;
                //$file->move(public_path().'/project-images/', $name);


                $attachment = new Attachment();
                //$attachment->attachment = $file->storeAs('storage/app/public/project-files', $name);
                $file->move(public_path() . '/project-files/', $name);
                $file_name = '/project-files/' . $name;
                $attachment->attachment = $file_name;
                $attachment->project_id = $project->id;
                $attachment->save();
            }
        }


        Alert::success('Successfully Created')->persistent('Dismiss');

        return back();
    }
    public function projScrenningShow(Request $request)
    {
        $projects = Project::with('attachment', 'contact')->get();
        //dd($projects);
        return $projects;
    }
    public function cancelProject($id)
    {
        Project::Where('id', $id)->update(['status' => 'Cancelled']);
        return back();
    }
    public function rejectProject($id)
    {
        Project::Where('id', $id)->update(['status' => 'Rejected']);
        return back();
    }
    public function approveProject(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'remarks' => 'required|min:3|max:1000',
        ]);

        Alert::question('Approve this project', 'Are you sure about this?');
        Project::Where('id', $request->id)->update(
            [
                'status' => 'Approved',
                'remarks' =>  $request->remarks
            ]
        );
        Alert::success('Approved', 'Successfully Approved');
        return back();
    }
    public function buyOutProject(Request $request)
    {
        Project::Where('id', $request->id)->update(
            [
                'status' => 'Buyout'
            ]
        );
        Alert::success('Buyout', 'Successfully updated');
        return back();
    }
    public function saveBuyoutType(Request $request){
        // dd($request);

        $this->validate($request, [
            'buyout_type' => 'required',
        ]);

        Project::Where('id', $request->idx)->update(
            [
                'buyout_type' => $request->buyout_type,
            ]
        );
        Alert::success('Buyout type', 'Successfully Updated')->persistent('Dismiss');
        return back();


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
