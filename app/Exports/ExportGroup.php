<?php

namespace App\Exports;

use App\Models\Group;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportGroup implements FromCollection
{
    public $id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lead::where('group_id',$this->id)->get()->map(function($lead) {
            return [
               'name' => $lead->name,
               'email' => $lead->email,
               'phone' => $lead->phone,
               'address' => $lead->address,
            ];
         });;
    }
}
