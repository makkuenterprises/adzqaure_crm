<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Employee Delete Controller
|--------------------------------------------------------------------------
|
| Delete operations for employee are handled from this controller.
|
*/

interface EmployeeDelete
{

    
}

class EmployeeDeleteController extends Controller implements EmployeeDelete
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
