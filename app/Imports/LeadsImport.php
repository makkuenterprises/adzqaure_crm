<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Http\Request;

class LeadsImport implements ToModel ,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {

        $request = request()->all();
      
        return new Lead([
            "name" => $row[0],
            "email" => $row[1],
            "phone" => $row[2],
            "address" => $row[3],
            "status" => false,
            'group_id'=> $request['group_id'],
            // 'employee_id'=> $request['employee_id'] 
        ]);
    }
}