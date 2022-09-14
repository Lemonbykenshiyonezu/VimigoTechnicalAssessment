<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\students;
use App\Http\Resources\v1\studentsResource;
use App\Http\Resources\v1\studentsCollection;
use App\filters\v1\studentsfilter;
use App\Http\Requests\v1\StorestudentsRequest;
use App\Http\Requests\v1\UpdatestudentsRequest;
use Illuminate\Support\Arr;
use App\Http\Requests\v1\BulkStorestudentsRequest;

class studentsController extends Controller
{
    public function index(Request $request)
    {
        $filter= new studentsfilter();
        $queryItem = $filter-> transform($request);

        if (count($queryItem)== 0){
            return new studentsCollection(students::paginate());
            //return new studentsCollection(students::where("studycourse","gamedev")->paginate());

        }
        else{
            return new studentsCollection(students::where($queryItem)->paginate());
        }
        
    }
    //
    public function show($input){
        $data= students::all()[$input];
        return new studentsResource($data);
    }
    public function store(StorestudentsRequest $request){
        return new studentsResource(students::create($request->all()));
    }

    public function bulkStore(BulkStorestudentsRequest $request){
        $bulk= collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,['id']);
        });
        students::insert($bulk->toArray());
    }
    public function importstudents(Request $request){
        return view('students.import');
    }
    public function uploadstudents(Request $request){
        Excel::import(new studentsImport, $request->file);

        return redirect()->route('students')->with('success','student imported successfully');
    }

    public function update(UpdatestudentsRequest $request, $input){
        $data= students::all()[$input];
        $data->update($request->all());
    }
    public function destroy($input){
        $data=students::where('id',$input+1)->firstorfail()->delete();
        echo "id: ",$input+1;
        return "student record deleted id:";

    }

}
