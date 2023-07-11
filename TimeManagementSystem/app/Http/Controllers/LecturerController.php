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
        ->get();
        return view('attendance', compact('classes','attendances'));
    }
    public function insertAttendance(Request $request){
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
        
        $class = DB::table('class')->where('class_id', $request->class_id)->first();

        $students = DB::table('attendance_linker')
        ->join('users', 'attendance_linker.student_id', '=', 'users.id')
        ->where('att_id',$request->att_id)
        ->get();


        $redir = 'assignclass?class_id=';
        $redir .= strval($class->class_id);

        return view("/assignclass", compact('class','students'));

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
        $leaves =DB::table('leave_approval')->get();

        return view('leaveapprovallist');
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