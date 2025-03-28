<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Employee Create Controller
|--------------------------------------------------------------------------
|
| Create operations for employee are handled from this controller.
|
*/

interface EmployeeCreate
{

    
}

class EmployeeCreateController extends Controller implements EmployeeCreate
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
}
