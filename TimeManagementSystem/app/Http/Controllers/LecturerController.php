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

        $attendances = DB::table('attendance_list')
        ->join('class', 'attendance_list.class_id', '=', 'class.class_id')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.lecturer_id', Auth::user()->id)
        ->get();

        $classes = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('lecturer_id', Auth::user()->id)
        ->get();
        return view('attendance', compact('classes','attendances'));
    }
    public function insertAttendance(){
        $classes = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('lecturer_id', Auth::user()->id)
        ->get();

        
        return view('attendance', compact('classes'));
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