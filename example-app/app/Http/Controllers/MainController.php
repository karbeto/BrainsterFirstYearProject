<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $events = Events::all()->toJson();
        return view("app.index" , compact('events'));
    }
}
