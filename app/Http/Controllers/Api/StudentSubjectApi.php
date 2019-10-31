<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Exception;

class StudentSubjectApi extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getScoreByStudentCode(){
        $student_code = $this->request->code;
        try{
            $student = Student::where('code',$student_code)->first();
            foreach($student->subjects as $subject){
                $id = $subject->id;
                $json[$id]['name'] = (string)$subject->name;
                $json[$id]['credit'] = (int)$subject->credit;
                $json[$id]['process_score'] = (float)$subject->pivot->process_score;
                $json[$id]['mid_score'] = (float)$subject->pivot->mid_score;
                $json[$id]['end_score'] = (float)$subject->pivot->end_score;
            }
    
            return response(json_encode($json),200); 
        }
        catch(Exception $e){
            return response('',404);
        }
    }
}
