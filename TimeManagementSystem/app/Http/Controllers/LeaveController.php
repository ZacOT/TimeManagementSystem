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
        $classes = DB::table('class')->where('sem_id',$cur_sem->sem_id)->get(); 
        return view('applyleave',compact('student','classes'));
    }
    public function getLeaveApplication(){

        return view('leaveapplication');
        
    }


}
