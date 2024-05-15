<?php

namespace App\Http\Controllers;

use App\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notification = DB::table('notifications')->latest()->first();

//        $queues = Queue::all();
        $queues = Queue::orderByRaw("CASE WHEN service = 'EMERGENCY' THEN 0 ELSE 1 END")->where('publication',true)->get();
        return view('welcome',compact('queues','notification'));
//        return view('welcome');
    }
}
