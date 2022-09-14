<?php

namespace App\filters\v1;

use Illuminate\Http\Request;
use App\filters\apifilter;

class studentsfilter extends apifilter{
    protected $safeParms= [
        'name'=>['eq'],
        'email'=>['eq'],
        'studycourse'=>['eq']
    ];

    protected $columnMap = [
        //
    ];

    protected $operatorMap=[
        'eq'=>'='
    ];


    
}