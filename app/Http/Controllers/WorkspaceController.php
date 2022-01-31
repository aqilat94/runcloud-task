<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = auth()->user()->workspaces;

        return view('workspaces.index' , compact('workspaces'));
    }

    public function store(WorkspaceRequest $request)
    {
        Workspace::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with(['alert-type' => 'alert-success', 'alert' => 'Your Workspace Created']);
    }

    public function show(Workspace $workspace)
    {
        $this->authorize('viewWorkspace', $workspace);

        $tasks = $workspace->tasks;
        
        return view('workspaces.show', compact(
            'workspace',
            'tasks'
        ));
    }

    public function destroy(Workspace $workspace)
    {
        $workspace->delete();

        return redirect()->route('workspace:index')->with(['alert-type' => 'alert-success', 'alert' => 'Your Workspace Deleted']);
    }
}
