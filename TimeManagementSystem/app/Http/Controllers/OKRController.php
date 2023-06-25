<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OKRController extends Controller
{
    public function getObjectives(){

        $objectives = DB::table('objectives')
        ->where('u_id', Auth::user()->id)
        ->join('semesters', 'objectives.sem_id', '=', 'semesters.sem_id')
        ->select('objectives.obj_id','objectives.title','objectives.description','semesters.sem_name')
        ->get();

        $semesters = DB::table('semesters')->get();
        return view('objectives', compact('objectives','semesters'));
    }

    public function insertObjectives(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'semester' => 'required'
        ]);

        
        //Get Semester

        $title = $request->input('title');
        $description = $request->input('description');
        $semester = $request->input('semester');
        $user = Auth::user()->id;

        $data= array(
            "title" => $title,
            "description" => $description,
            "u_id" => $user,
            "semester_id"=> $semester,
        );
        
        DB::table('objectives')->insert($data);

        return redirect('objectives');
    }

    public function deleteObjectives(){
        return view('objectives');
    }

    public function getOKR(Request $request){
        $obj_id = $request->id;

        
        $objectives = DB::table('objectives')
        ->where('obj_id', $obj_id)
        ->join('semesters', 'objectives.sem_id', '=', 'semesters.sem_id')
        ->select('objectives.obj_id','objectives.title','objectives.description','semesters.sem_name')
        ->get();

        $keyresults = DB::table('keyresults')
        ->where('obj_id', $obj_id)
        ->get();

        return view('okr', compact('objectives','keyresults'));
    }

    public function insertOKR(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'status' => 'required'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $due_date = $request->input('due_date');
        $status = $request->input('status');
        $obj_id = $request->input('obj_id');

        $data= array(
            "title" => $title,
            "description" => $description,
            "due_date" => $due_date,
            "status"=> $status,
            "obj_id"=>$obj_id
        );
        
        $redir = 'okr?id=';
        $redir .= strval($obj_id);

        DB::table('keyresults')->insert($data);

        return redirect($redir);
    }
    public function editKR(){

        return view('okr');
    }
    public function deleteKR(Request $request){
        
        $obj_id = $request->obj_id;
        $kr_id = $request->kr_id;

        DB::table('keyresults')->where('kr_id', $kr_id)->delete();

        $redir = 'okr?id=';
        $redir .= strval($obj_id);
        return redirect($redir);
    }
}
