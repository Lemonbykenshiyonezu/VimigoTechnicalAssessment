<?php

namespace App\Imports;

use App\Models\students;
use Maatwebsite\Excel\Concerns\ToModel;

class studentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new students([
            "name"=>$row['name'],
            "address"=>$row['address'],
            "studycourse"=>$row['studycourse']
        ]);
    }
}
