<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $workspaces = auth()->user()->workspaces;

        $tasks = auth()->user()->tasks;

        $incomplete_task = $tasks->where('status', 0);

        $complete_task = $tasks->where('status', 1);

        return view('home', compact(
            'workspaces',
            'incomplete_task',
            'complete_task'
        ));
    }
}
