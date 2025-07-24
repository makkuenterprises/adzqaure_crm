<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Payment;

class EmployeeProjectController extends Controller
{
    public function viewProjectList()
    {
        $status = request('status');
        if ($status) {
            $projects = Project::where('status', $status)->paginate(5);
        } else {
            $projects = Project::paginate(5);
        }
        return view('employee.sections.project.project-list', [
            'projects' => $projects,
            'status' => $status,
        ]);
    }


    /** View Project Create **/
    public function viewProjectCreate()
    {

        return view('employee.sections.project.project-create');
    }

    /** View Project Update **/
    public function viewProjectUpdate($id)
    {
        $project = Project::find($id);
        return view('employee.sections.project.project-update', ['project' => $project]);
    }

    /** View Project Preview **/
    public function viewProjectPreview($id)
    {
        $project = Project::find($id);
        $payments = Payment::where('project_id', $id)->get();
        $credit_amount = Payment::where('project_id', $id)->where('type', 'Credit')->sum('amount');
        $debit_amount = Payment::where('project_id', $id)->where('type', 'Debit')->sum('amount');
        return view('employee.sections.project.project-preview', [
            'project' => $project,
            'payments' => $payments,
            'credit_amount' => $credit_amount,
            'debit_amount' => $debit_amount
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Project Create
    |--------------------------------------------------------------------------
    */
    public function handleProjectCreate(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'project_link' => ['nullable', 'string'],
            'resource_link' => ['nullable', 'string'],
            'end_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $project = new Project();
            $project->customer_id = $request->input('customer_id');
            $project->name = $request->input('name');
            $project->project_link = $request->input('project_link');
            $project->resource_link = $request->input('resource_link');
            $project->end_date = $request->input('end_date');
            $project->amount = $request->input('amount');
            $project->status = $request->input('status');
            $result  = $project->save();

            if ($result) {
                return redirect()->route('employee.view.customer.preview', ['id' => $request->input('customer_id')])->with('message', [
                    'status' => 'success',
                    'title' => 'Project created',
                    'description' => 'Project is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Project Update
    |--------------------------------------------------------------------------
    */
    public function handleProjectUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'project_link' => ['nullable', 'string'],
            'resource_link' => ['nullable', 'string'],
            'start_date' => ['nullable', 'string'],
            'end_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'pending_amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $project = Project::find($id);
            $project->name = $request->input('name');
            $project->project_link = $request->input('project_link');
            $project->resource_link = $request->input('resource_link');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->amount = $request->input('amount');
            $project->pending_amount = $request->input('pending_amount');
            $project->status = $request->input('status');
            $result  = $project->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

     public function changeStatus($id, $status)
    {
        // dd("test");
        $validStatuses = ['OnProgress', 'Pending', 'Closed'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }
        $project = Project::findOrFail($id);
        if ($project->status === 'Pending' && $status === 'OnProgress') {
            $project->status = 'OnProgress';
        } elseif ($project->status === 'OnProgress' && $status === 'Closed') {
            $project->status = 'Closed';
        }

        $result = $project->save();


        if ($result) {
            return redirect()->back()->with('message', [
                'status' => 'success',
                'title' => 'Changes Saved',
                'description' => 'The status are successfully saved'
            ]);
        } else {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => 'There is an internal server issue please try again.'
            ]);
        }
    }

}
