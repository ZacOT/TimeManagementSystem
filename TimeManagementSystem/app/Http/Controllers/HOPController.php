<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HOPController extends Controller
{
    public function getClassList(){
        
        $hop_id = Auth::user()->id;
        $program = DB::table('programs')->where('hop_id',$hop_id)->first();
        $classes = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('program_id', $program->program_id)
        ->get();

        $semesters = DB::table('semesters')->get();
        $courses = DB::table('course')->get();
        $classtypes = DB::table('class_type')->get();
        $lecturers = DB::table('users')->where('role', 2)->orWhere('role', 1)->get();

        return view('classlist', compact("program","classes","courses","classtypes","lecturers","semesters"));
    }

    public function insertClassList(Request $request){
        
        $this->validate($request, [
            'program'=>'required',
            'course'=>'required',
            'class_type'=>'required',
            'class_name'=>'required|max:32',
            'lecturer'=>'required',
            'semester'=>'required',
            'first_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ]);

        $program_id = $request->input('program');
        $course_id = $request->input('course');
        $class_type = $request->input('class_type');
        $class_name = $request->input('class_name');
        $lecturer_id = $request->input('lecturer');
        $sem_id = $request->input('semester');
        $class_firstdate = $request->input('first_date');
        $class_starttime = $request->input('start_time');
        $class_endtime = $request->input('end_time');

        $data=array(
            'program_id'=>$program_id,
            'lecturer_id'=>$lecturer_id,
            'course_id'=>$course_id,
            'sem_id'=>$sem_id,
            'class_name'=>$class_name,
            'class_type'=>$class_type,
            'class_firstdate'=>$class_firstdate,
            'class_starttime'=>$class_starttime,
            'class_endtime'=>$class_endtime,
        );
        DB::table('class')->insert($data);
        return redirect()->route('classlist');
    }
}