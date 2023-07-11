<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function applyLeave(){
        $student = Auth::user();
        $cur_sem = DB::table('semesters')->latest('start_date')->first();

        //Get classes where User is in for this semester assuming current semsester is latest
        $classes= DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.sem_id',$cur_sem->sem_id)
        ->get(); 

        return view('applyleave',compact('student','classes'));
    }

    public function addSelClass(Request $request){
        
        $selclass = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.class_id',$request->input('sel_class'))
        ->get();

        return view('applyleave',compact('student','classes'));
    }
    public function insertLeave(Request $request){
        
        $documentName = $request->document_img->getClientOriginalName();
        $request->document_img->move(public_path('documents'), $documentName);
    }
    public function getLeaveApplication(){

        return view('leaveapplication');
        
    }


}
