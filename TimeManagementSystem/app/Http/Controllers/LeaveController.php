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

        $this->validate($request, [
            'reason'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'affectedclass'=>'required',
        ]);
        
        $applicant_id = Auth::user()->id;
        $application_date = date('Y-m-d');
        $leave_startdate = $request->input('start_date');
        $leave_enddate = $request->input('end_date');
        $reason = $request->input('reason');
        $document_img = $request->file('document');
        $documentName = $document_img->getClientOriginalName();
        $document_img->move(public_path('images/documents'), $documentName);

        //create application
        $data=array(
            "applicant_id"=>$applicant_id,
            "application_date"=>$application_date,
            "leave_startdate"=>$leave_startdate,
            "leave_enddate"=>$leave_enddate,
            "document"=>$documentName,
            "reason"=>$reason,
            "status"=>0,
        );
         
        $leave_id = DB::table('leave_application')->insertGetId($data, "leave_id");

        //Check affected courses
        $affectedclasses = $request->input('affectedclass');
        foreach ($affectedclasses as $a){
            $class_id = $a['class_id'];
            $temp = DB::table('class')->where('class_id',$class_id)->first();
            
            //lecturer of affected courses
            $lec_id = $temp->lecturer_id;

            //create leave approval
            $leavedata = array(
                "leave_id" => $leave_id,
                "class_id" => $class_id,
                "lec_id" => $lec_id,
                "status" => 0,
            );

            DB::table('leave_approval')->insert($leavedata);


        }
    }

    public function checkAttendance(){

        $cur_sem = DB::table('semesters')->latest('start_date')->first();
        $absents = DB::table('attendance_linker')
        ->join('attendance_list', 'attendance_linker.att_id', '=','attendance_list.att_id')
        ->join('class', 'attendance_list.class_id', '=', 'class.class_id')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('student_id', Auth::user()->id)
        ->where('status', 1)
        ->get();

        $classes = DB::table('class')
        ->join('class_type', 'class.class_type', '=', 'class_type.classtype_id')
        ->join('users', 'class.lecturer_id', '=', 'users.id')
        ->join('course', 'class.course_id', '=', 'course.course_id')
        ->join('semesters', 'class.sem_id', '=', 'semesters.sem_id')
        ->where('class.sem_id', $cur_sem->sem_id)
        ->where('class.lecturer_id', Auth::user()->id)
        ->get();
        return view('attendancecheck', compact('classes','absents'));

        return view('leaveapprovallist');
    }
    public function getLeaveApplication(Request $request){

        //get leave id
        $leave_id = $request->input('leave_id');

        //get leave
        $leave = DB::table('leave_application')
        ->join('users','leave_application.applicant_id','=','users.id') //get details of applicant
        ->where('leave_id',$leave_id)
        ->first();
        
        //get applicant
        $student = DB::table('users')->where('id',$leave->applicant_id)->first();
        
        //get related leave approvals
        $leaveapprovals = DB::table('leave_approval')
        ->join('users','leave_approval.lec_id','=','users.id') //get details of lecturer
        ->join('class','leave_approval.class_id','=','class.class_id') //get details of class
        ->where('leave_id',$leave_id)->get();


        return view('leaveapplication', compact('student','leave','leaveapprovals'));
    }

    public function getLeavesList(){

        //get leave
        $leaves = DB::table('leave_application')
        ->join('users','leave_application.applicant_id','=','users.id') //get details of applicant
        ->where('applicant_id', Auth::user()->id)
        ->get();


        return view('leavelist', compact('leaves'));
    }
}
