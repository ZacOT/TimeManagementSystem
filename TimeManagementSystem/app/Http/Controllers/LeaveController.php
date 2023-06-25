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

        $classes= DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.sem_id',$cur_sem->sem_id)
        ->get(); 

        return view('applyleave',compact('student','classes'));
    }
    public function insertLeave(Request $request){
        
        $imageName = $request->book_cover_img->getClientOriginalName();
        $request->book_cover_img->move(public_path('images'), $imageName);
    }
    public function getLeaveApplication(){

        return view('leaveapplication');
        
    }


}
