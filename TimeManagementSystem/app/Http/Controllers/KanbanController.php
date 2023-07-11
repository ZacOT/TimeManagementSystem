<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KanbanController extends Controller
{   
    public function getWorkspace(){

        $kboards = DB::table('kanban_board')->where('owner_id',Auth::user()->id)->get();

        return view('workspace', compact('kboards'));
    }
    
    public function getKanbanBoard(Request $request){

        $kboard_id = $request->input('kboard_id');
        $cards = DB::table('kanban_card')->get();
        $categories = DB::table('kanban_category')->where('kboard_id',$kboard_id)->get();
        $comments = DB::table('kanban_comment')
        ->join("users", "kanban_comment.author_id","=","users.id")
        ->get();

        return view('kanban', compact('kboard_id','categories','cards','comments'));
    }

    public function insertKanbanBoard(Request $request){
        $owner_id = Auth::user()->id;
        $kbname = $request->input('kbname');
        $description = $request->input('description');

        $data=array(
            "owner_id"=>$owner_id,
            "name"=>$kbname,
            "description"=>$description,
        );

        DB::table('kanban_board')->insert($data);

        return redirect()->route('workspace');
    }

    public function insertKanbanCategory(Request $request){

        $this->validate($request, [
            'kboard_id'=>'required',
            'name'=>'required',
        ]);

        $kboard_id = $request->input('kboard_id');
        $name = $request->input('name');

        $data=array(
            "kboard_id"=>$kboard_id,
            "name"=>$name,
        );

        DB::table('kanban_category')->insert($data);

        $redir = 'kanban?kboard_id=';
        $redir .= strval($kboard_id);
        return redirect($redir);
    }

    public function updateKanbanCategory(Request $request){
        $this->validate($request, [
            'kcat_id'=>'required',
            'name'=>'required',
        ]);
        $kboard_id = $request->input('kboard_id');
        $kcat_id = $request->input('kcat_id');
        $name = $request->input('name');

        $data=array(
            "name"=>$name,
        );

        DB::table('kanban_category')->where("kcat_id",$kcat_id)->update($data);

        $redir = 'kanban?kboard_id=';
        $redir .= strval($kboard_id);
        return redirect($redir);
    }

    public function insertKanbanCard(Request $request){
        $this->validate($request, [
            'kcat_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'due'=>'required',
        ]);

        $kboard_id = $request->input('kboard_id');
        $kcat_id = $request->input('kcat_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $create_date = date('Y-m-d H:i:s');
        $due = $request->input('due');

        $data=array(
            "kcat_id"=>$kcat_id,
            "title"=>$title,
            "description"=>$description,
            "create_date"=>$create_date,
            "end_date"=>$due,
        );

        DB::table('kanban_card')->insert($data);

        $redir = 'kanban?kboard_id=';
        $redir .= strval($kboard_id);
        return redirect($redir);
    }

    public function editKanbanCard(Request $request){
        $this->validate($request, [
            'kcat_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'due'=>'required',
        ]);

        $kcard_id = $request->input('kcard_id');
        $kboard_id = $request->input('kboard_id');
        $kcat_id = $request->input('kcat_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $due = $request->input('due');

        $data=array(
            "kcat_id"=>$kcat_id,
            "title"=>$title,
            "description"=>$description,
            "end_date"=>$due,
        );

        DB::table('kanban_card')->where('kcard_id',$kcard_id)->update($data);

        $redir = 'kanban?kboard_id=';
        $redir .= strval($kboard_id);
        return redirect($redir);
    }

    public function insertComment(Request $request){
        $kboard_id = $request->input('kboard_id');

        $this->validate($request, [
            'description'=>'required',
        ]);


        $kcard_id = $request->input('kcard_id');
        $author_id = Auth::user()->id;
        $description = $request->input('description');
        
        $data=array(
            "kcard_id"=>$kcard_id,
            "author_id"=>$author_id,
            "description"=>$description,
        );
        

        DB::table('kanban_comment')->insert($data);

    
        $redir = 'kanban?kboard_id=';
        $redir .= strval($kboard_id);
        return redirect($redir);
    }
}
