<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $workspaces = auth()->user()->workspaces()->with('tasks')->get();
        
        return view('tasks.index', compact('workspaces'));
    }

    public function store(TaskRequest $request, Workspace $workspace)
    {
        Task::create([
            'name' => $request->name,
            'deadline' => $request->due_date." ".$request->due_time,
            'description' => $request->description,
            'workspace_id' => $workspace->id,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with(['alert-type' => 'alert-success', 'alert' => 'Your Task Created']);

    }

    public function show(Task $task)
    {
        $this->authorize('viewTask', $task);

        return view('tasks.show', compact('task'));
    }

    public function update(Task $task)
    {
        $task->update([
            'date_complete' => Carbon::now(),
            'status' => 1,
        ]);

        return redirect()->route('workspace:show', $task->workspace)->with(['alert-type' => 'alert-success', 'alert' => 'Task Completed']);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('workspace:show', $task->workspace)->with(['alert-type' => 'alert-success', 'alert' => 'Your Task Deleted']);
    }
}
