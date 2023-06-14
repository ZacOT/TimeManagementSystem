<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OKRController extends Controller
{
    public function getObjectives(){
        return view('objectives');
    }

    public function getOKR(){
        return view('okr');
    }
}
