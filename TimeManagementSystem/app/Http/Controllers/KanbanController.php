<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KanbanController extends Controller
{   
    public function getKanbanBoard(){

        return view('kanban');
    }

    public function insertKanbanBoard(Request $request){
        $uid = Auth::id();
        $kbname = $request->input('kbname');

        $data=array(
            "uid"=>$uid,
            "kbname"=>$kbname,
        );
        DB::table('kanbanboard')->insert($data);
    }

    public function insertKanbanCategory(){

    }

    public function editKanbanCategory(){

    }

    public function queryKanbanCategory(){

    }

    public function insertKanbanCard(){

    }

    public function editKanbanCard(){

    }
    public function queryKanbanCard(){

    }
}
