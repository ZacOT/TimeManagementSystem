<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    #ADMIN
    public function getAdmin()
    {
        return view('admin');
    }

    #USERS
    public function getUsers()
    {   
        $users = DB::table('users')->get();
        return view('manageusers', compact('users'));
    }

    #STUDENTS
    public function getStudents()
    {   
        $students = DB::table('users')->where("role", 0)->get();
        return view('managestudents', compact('students'));
    }  
    public function insertStudent(Request $request){
        //Validate All Fields of Add Student Form
        $this->validate($request, [
            'username'=>'required|max:255|unique:users,username',
            'password'=>'required|confirmed|max:32',
            'password_confirmation'=>'required|max:32',
            'email'=>'required|unique:users,email',
            'contact_no'=>['required','regex:/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/'],
            'f_name'=>'required|max:255',
            'l_name'=>'required|max:255',
            'matrics'=>'required|max:15',
        ]);

        //Get all fields
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $f_name = $request->input('f_name');
        $l_name = $request->input('l_name');
        $matrics = $request->input('matrics');
        $role = 0;
        
        //Insert into Data Array
        $data=array(
            "username"=>$username,
            "password"=>$password,
            "email"=>$email,
            "contact_no"=>$contact_no,
            "f_name"=>$f_name,
            "l_name"=>$l_name,
            "matrics"=>$matrics,
            "role"=>$role);

        //Insert Data Array into MYSQL Table
        DB::table('users')->insert($data);
        
        //Reroute back to manage student page with reflected changes
        return redirect()->route('managestudents');
    }

    public function editStudent(Request $request){
        
        $user = DB::table("users")->where("id", $request->input("student_id"))->first();

        $this->validate($request, [
            'username'=>'max:255|unique:users,username,'.$user->id,
            'email'=>'unique:users,email,'.$user->id,
            'contact_no'=>['regex:/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/','unique:users,contact_no,'.$user->contact_no],
            'f_name'=>'max:255',
            'l_name'=>'max:255',
            'matrics'=>'max:15',
        ]);
        $student_id = $request->input("student_id");
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $f_name = $request->input('f_name');
        $l_name = $request->input('l_name');
        $matrics = $request->input('matrics');
        $role=0;

        if(empty($password)){
            $data=array(
                "username"=>$username,
                "email"=>$email,
                "contact_no"=>$contact_no,
                "f_name"=>$f_name,
                "l_name"=>$l_name,
                "matrics"=>$matrics,
                "role"=>$role);
        }
        else if(!empty($password)){
            $this->validate($request, [
                'password'=>'confirmed|max:32',
                'password_confirmation'=>'max:32',
             ]);
            $password = $request->input('password');
            $data=array(
                "username"=>$username,
                "password"=>$password,
                "email"=>$email,
                "contact_no"=>$contact_no,
                "f_name"=>$f_name,
                "l_name"=>$l_name,
                "matrics"=>$matrics,
                "role"=>$role);
        }

        DB::table('users')->where("id",$student_id)->update($data);

        return redirect()->route('managestudents');
    }

    #FACULTY
    public function getFaculty()
    {   
        $facultys = DB::table('users')->whereIn("role", [1,2])->get();
        return view('managefaculty', compact('facultys'));
    }
    public function insertFaculty(Request $request){
        
        $this->validate($request, [
            'username'=>'required|max:255|unique:users,username',
            'password'=>'required|confirmed|max:32',
            'password_confirmation'=>'required|max:32',
            'email'=>'required|unique:users,email',
            'contact_no'=>['required','regex:/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/'],
            'f_name'=>'required|max:255',
            'l_name'=>'required|max:255',
            'matrics'=>'required|max:15',
            'role'=>'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $f_name = $request->input('f_name');
        $l_name = $request->input('l_name');
        $matrics = $request->input('matrics');
        $role = $request->input('role');

        $data=array(
            "username"=>$username,
            "password"=>$password,
            "email"=>$email,
            "contact_no"=>$contact_no,
            "f_name"=>$f_name,
            "l_name"=>$l_name,
            "matrics"=>$matrics,
            "role"=>$role);

        DB::table('users')->insert($data);

        return redirect()->route('managefaculty');
    }

    public function editFaculty(Request $request){
        $user = DB::table("users")->where("id", $request->input("faculty_id"))->first();

        $this->validate($request, [
            'username'=>'max:255|unique:users,username,'.$user->id,
            'email'=>'unique:users,email,'.$user->id,
            'contact_no'=>['regex:/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/','unique:users,contact_no,'.$user->contact_no],
            'f_name'=>'max:255',
            'l_name'=>'max:255',
            'matrics'=>'max:15',
        ]);

        $faculty_id = $request->input("faculty_id");
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $f_name = $request->input('f_name');
        $l_name = $request->input('l_name');
        $matrics = $request->input('matrics');
        $role=$request->input('role');

        if(empty($password)){
            $data=array(
                "username"=>$username,
                "email"=>$email,
                "contact_no"=>$contact_no,
                "f_name"=>$f_name,
                "l_name"=>$l_name,
                "matrics"=>$matrics,
                "role"=>$role);
        }
        else if(!empty($password)){
            $this->validate($request, [
                'password'=>'confirmed|max:32',
                'password_confirmation'=>'max:32',
             ]);
            $password = $request->input('password');
            $data=array(
                "username"=>$username,
                "password"=>$password,
                "email"=>$email,
                "contact_no"=>$contact_no,
                "f_name"=>$f_name,
                "l_name"=>$l_name,
                "matrics"=>$matrics,
                "role"=>$role);
        }

        DB::table('users')->where("id",$faculty_id)->update($data);

        return redirect()->route('managefaculty');
    }

    #COURSES
    public function getCourses(Request $request){
        $courses = DB::table('course')->get();
        return view('managecourses', compact('courses'));
    }

    public function insertCourse(Request $request){

        $this->validate($request, [
            'course_name'=>'required|unique:course,course_name',
            'course_code'=>'required|unique:course,course_code',
        ]);

        $course_name = $request->input('course_name');
        $course_code = $request->input('course_code');

        $data=array(
            "course_name"=>$course_name,
            "course_code"=>$course_code
        );
        DB::table('course')->insert($data);
        return redirect()->route('managecourses');
    }
    public function editCourse(Request $request){

        $course_id = $request->input('course_id');
        $this->validate($request, [
             'course_name'=>['required', Rule::unique('course')->ignore($course_id, 'course_id')],
            'course_code'=>['required', Rule::unique('course')->ignore($course_id, 'course_id')],
        ]);
        
        $course_name = $request->input('course_name');
        $course_code = $request->input('course_code');

        $data=array(
            "course_name"=>$course_name,
            "course_code"=>$course_code
        );
        DB::table('course')->where('course_id', $course_id)->update($data);
        return redirect()->route('managecourses');
    }

    #SEMESTERS
    public function getSemesters(Request $request){
        $semesters = DB::table('semesters')->get();

        return view('managesemesters', compact('semesters'));
    }


    public function insertSemester(Request $request){

        $this->validate($request, [
            'semester_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        
        $semester_name = $request->input('semester_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        $data=array(
            "sem_name"=>$semester_name,
            "start_date"=>$start_date,
            "end_date"=>$end_date
        );

        DB::table('semesters')->insert($data);

        return redirect()->route('managesemesters');
    }

    public function editSemester(Request $request){

        $this->validate($request, [
            'sem_id' => 'required',
            'semester_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        
        $sem_id = $request->input('sem_id');
        $semester_name = $request->input('semester_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        $data=array(
            "sem_id"=>$sem_id,
            "sem_name"=>$semester_name,
            "start_date"=>$start_date,
            "end_date"=>$end_date
        );

        DB::table('semesters')->where('sem_id', $sem_id)->update($data);

        return redirect()->route('managesemesters');
    }

    public function deleteSemester(Request $request){

        $this->validate($request, [
            'sem_id' => 'required'
        ]);

        $sem_id = $request->input('sem_id');

        DB::table('semesters')->where('sem_id', $sem_id)->delete();
        return redirect()->route('managesemesters');
    }

    #PROGRAMS
    public function getPrograms(Request $request){
        $programs = DB::table('programs')
        ->join('users', 'programs.hop_id', '=', 'users.id')
        ->get();

        $hops = DB::table('users')->where('role', 2)->get();
        return view('manageprograms', compact('programs','hops'));
    }

    public function insertProgram(Request $request){

        $this->validate($request, [
            'program_name'=>'required',
            'program_code'=>'required',
            'hop_id'=>'required',
        ]);
        
        $program_name = $request->input('program_name');
        $program_code = $request->input('program_code');
        $hop_id = $request->input('hop_id');
        
        $data=array(
            "program_name"=>$program_name,
            "program_code"=>$program_code,
            "hop_id"=>$hop_id
        );

        DB::table('programs')->insert($data);

        return redirect()->route('manageprograms');
    }

    public function assignProgram(Request $request){
        
        $program = DB::table('programs')->where('program_id', $request->input('program_id'))->first();
        $students = DB::table('users')->where('role',3)->get();

        return view('assignprogram', compact('program','students'));
    }

    #CLASS
    public function getClassType(Request $request){
        $classtypes = DB::table('class_type')->get();
        return view('manageclasstypes', compact('classtypes'));
    }



}
