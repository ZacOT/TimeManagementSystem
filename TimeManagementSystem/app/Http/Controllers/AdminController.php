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
    public function getAdmin()
    {
        return view('admin');
    }
    public function getUsers()
    {   
        $users = DB::table('users')->get();
        return view('manageusers', compact('users'));
    }

    public function getStudents()
    {   
        $students = DB::table('users')->where("role", 0)->get();
        return view('managestudents', compact('students'));
    }

    public function getFaculty()
    {   
        $facultys = DB::table('users')->whereIn("role", [1,2])->get();
        return view('managefaculty', compact('facultys'));
    }

    
    public function insertStudent(Request $request){
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

        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $contact_no = $request->input('contact_no');
        $f_name = $request->input('f_name');
        $l_name = $request->input('l_name');
        $matrics = $request->input('matrics');
        $role = 0;

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

    public function getSemesters(Request $request){
        $semesters = DB::table('semesters')->get();

        return view('managesemesters', compact('semesters'));
    }

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

    public function getClassType(Request $request){
        $classtype = DB::table('class_type')->get();
        return view('manageaclasstype', compact('classtype'));
    }



}
