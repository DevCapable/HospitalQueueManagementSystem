<?php

namespace App\Http\Controllers\Admin;

use App\Queue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   public function index()
   {
       $totalCount = Queue::count();
       return view('admin.dashboard',compact('totalCount'));
   }
}
