<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Campaign;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| Employee API Controller
|--------------------------------------------------------------------------
|
| API operations for employee are handled from this controller.
|
*/
interface EmployeeAPI 
{
    public function handleLeadStatusUpdate(Request $request);

}

class EmployeeAPIController extends Controller implements EmployeeAPI
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Lead Status Update
    |--------------------------------------------------------------------------
    */
    public function handleLeadStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:leads'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $lead = Lead::find($request->id);
            $lead->status = ! (boolean)$lead->status;
            $lead->update();
            return response(['message' => 'Status updated','data' => $lead],200);
        }
    }
}