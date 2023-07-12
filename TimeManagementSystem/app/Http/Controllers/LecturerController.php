<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LecturerController extends Controller
{
    public function getAttendanceLeave(){

        return view('attendanceleavemenu');
    }

    public function getAttendance(){

        $cur_sem = DB::table('semesters')->latest('start_date')->first();
        $attendances = DB::table('attendance_list')
        ->join('class', 'attendance_list.class_id', '=', 'class.class_id')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->get();

        $classes = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.sem_id', $cur_sem->sem_id)
        ->where('class.lecturer_id', Auth::user()->id)
        ->get();
        return view('attendance', compact('classes','attendances'));
    }
    public function insertAttendance(Request $request){

        $this->validate($request, [
            'class_id'=>'required',
            'date'=>'required',
            'starttime'=>'required',
            'endtime'=>'required',
        ]);

        $class_id = $request->input('class_id');
        $date = $request->input('date');
        $starttime = $request->input('starttime');
        $endtime = $request->input('endtime');
        
        //Create new Attendance list then grab ID
        $data = array(
            'class_id' => $class_id,
            'att_date' => $date,
            'att_starttime' => $starttime,
            'att_endtime' => $endtime,
        );
        $id = DB::table('attendance_list')->insertGetId($data);
        
        //Grab Students that belong in class and insert into attendance
        $students = DB::table('class_linker')->where('class_id',$class_id)
        ->join('users', 'class_linker.student_id', '=', 'users.id')
        ->get();

        foreach ($students as $student){
            
            $attdata = array(
                'att_id'=>$id,
                'student_id'=>$student->id,
                'status'=>0, //default
            );

            DB::table('attendance_linker')->insert($attdata);
        }

        $redir = 'attendancelist?att_id=';
        $redir .= strval($id);
        return redirect($redir);
    }

    public function getAttendanceList(Request $request){
        
        $attendance = DB::table('attendance_list')->where('att_id', $request->att_id)->first();

        $students = DB::table('attendance_linker')
        ->join('users', 'attendance_linker.student_id', '=', 'users.id')
        ->where('att_id', $attendance->att_id)
        ->get();

        $class= DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class_id', $attendance->class_id)
        ->first();

        $redir = 'attendancelist?att_id=';
        $redir .= strval($attendance->att_id);

        return view("/attendancelist", compact('attendance','students','class'));
    }

    public function updateAttendanceList(Request $request){
        $att_id = $request->input('att_id');
        $att = $request->input('att');

        foreach ($att as $a){
            $student_id = $a['student'];
            $status = $a['status'];
            
            $data = array(
                'status'=>$status,
            );
            
            DB::table('attendance_linker')->where('att_id', $att_id)->where('student_id', $student_id)->update($data);
        }

        $redir = 'attendancelist?att_id=';
        $redir .= strval($att_id);
        return redirect($redir);
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

        return view('leavecourselist',compact('leaves'));
    }

    public function getLeaveCourseApproval(Request $request){

        //get leave id
        $leave_id = $request->input('leave_id');
        $approval_id = $request->input('approval_id');
        //get leave
        $leave = DB::table('leave_application')
        ->join('users','leave_application.applicant_id','=','users.id') //get details of applicant
        ->where('leave_id',$leave_id)
        ->first();

        //get applicant
        $student = DB::table('users')->where('id',$leave->applicant_id)->first();
        
        //get related leave approvals
        $leaveapproval = DB::table('leave_approval')
        ->join('users','leave_approval.lec_id','=','users.id') //get details of lecturer
        ->join('class','leave_approval.class_id','=','class.class_id') //get details of class
        ->join('course','class.course_id','=','course.course_id') //get details of class
        ->where('approval_id',$approval_id)->first();


        return view('leavecourseapproval', compact('student','leave','leaveapproval'));
    }

    public function approveLeaveCourse(Request $request){
        $approval_id = $request->input('approval_id');
        $date = date('Y-m-d');

        $data = array(
            'comment' => $request->input('comment'),
            'status' => 1,
            'date' => $date,
        );

        DB::table('leave_approval')->where('approval_id',$approval_id)->update($data);

        return redirect()->route('leavecourselist');
    }

    public function debug(Request $request){
        $att_id = $request->input('att_id');
        $att = $request->input('att');

        foreach ($att as $a){
            $student_id = $a['student'];
            $status = $a['status'];
            
            $data = array(
                'status'=>$status,
            );
            
            DB::table('attendance_linker')->where('att_id', $att_id)->where('student_id', $student_id)->update($data);
        }

        return view("/debug", compact('att'));
    }
}