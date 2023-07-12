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


    public function getAssign(Request $request){

        $students = DB::table('users')
        ->where('role', 0)
        ->get();

        $assignedstudents = DB::table('class_linker')
        ->where('class_id', $request->input('class_id'))
        ->pluck('student_id')->toArray();


        $class= DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class_id', $request->input('class_id'))
        ->first();

        return view("/assignstudent", compact('students','assignedstudents','class'));
    }
    
    public function assignStudents(Request $request){

        $class_id = $request->input('class_id');
        $students = $request->input('assign');

        $assignedstudents = DB::table('class_linker')
        ->where('class_id', $request->input('class_id'))
        ->pluck('student_id')->toArray();

        //Check if students are assigned already
        foreach ($students as $s){
            $student_id = $s['student'];
            $status = $s['status'];
            
            //if already assigned then update
            if(in_array($student_id, $assignedstudents)){
                //if already assigned then unassign
                if($status == 0){
                    DB::table('class_linker')->where('class_id', $class_id)->where('student_id', $student_id)->delete();
                }
                //if assigned remain same
                else if($status == 1){

                }
            }
            //if not assigned then insert
            else{
                //if assign
                if($status == 1){
                    $data = array(
                        'class_id'=>$class_id,
                        'student_id'=>$student_id
                    );
                    DB::table('class_linker')->insert($data);
                }
                //if unassigned remain same
                else if($status == 0){

                }
            }
        }

        $redir = 'assignclass?class_id=';
        $redir .= strval($class_id);
        return redirect($redir);
    }

    public function getLeaves(Request $request){

        //Get Leaves
        $leaves = DB::table('leave_application')
        ->join('users','leave_application.applicant_id','=','users.id')
        ->join('program_linker','users.id','=','program_linker.student_id')
        ->join('programs','program_linker.program_id','=','programs.program_id')
        ->where('programs.hop_id', Auth::user()->id)
        ->get();

        //Get all Leaves
        $getleaves = DB::table('leave_application')
        ->where('leave_id', $request->input('leave_id'))
        ->get();
        
        return view('leaveapprovallist', compact('leaves'));
    }

    public function getRelatedLeaves(){
        
        //related leaves to be approved
        $leaves = DB::table('leave_approval')
        ->join('class','leave_approval.class_id','=','class.class_id')
        ->join('class_type', 'class.class_type','=','class_type.classtype_id')
        ->join('leave_application', 'leave_approval.leave_id','=','leave_application.leave_id')
        ->join('users', 'leave_application.applicant_id','=','users.id')
        ->where('lec_id', Auth::user()->id)
        ->get();

        return view('leaveapprovallist',compact('leaves'));
    }

    public function getLeaveApproval(Request $request){

                //get leave id
                $leave_id = $request->input('leave_id');

                //get leave
                $leave = DB::table('leave_application')
                ->join('users','leave_application.applicant_id','=','users.id') //get details of applicant
                ->where('leave_id',$leave_id)
                ->first();
                $student = DB::table('users')->where('id',$leave->applicant_id)->first();
                //get related leave approvals
                $leaveapprovals = DB::table('leave_approval')
                ->join('users','leave_approval.lec_id','=','users.id') //get details of lecturer
                ->join('class','leave_approval.class_id','=','class.class_id') //get details of class
                ->join('course','class.course_id','=','course.course_id') //get details of class
                ->where('leave_id',$leave_id)->get();
        
                return view('leaveapproval', compact('student','leave','leaveapprovals'));
    }

    public function approveLeave(Request $request){
        $leave_id = $request->input('leave_id');

        $data = array(
            'status' => 1,
        );

        DB::table('leave_application')->where('leave_id',$leave_id)->update($data);

        return redirect()->route('leaveapprovalist');
    }

}