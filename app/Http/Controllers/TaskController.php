<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $users = User::all();
        $statuses = TaskStatus::all();
        return view('tasks.create', compact('task', 'users', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:5',
            'assigned' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
        $task = new Task();
        if ($data['assigned'] !== '') {
            $task->assigned_to_id = $data['assigned'];
        }
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->created_by_id = Auth::user()->id;
        $task->status_id = $data['status'];
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::all();
        $statuses = TaskStatus::all();
        return view('tasks.edit', compact('task', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|min:5',
            'assigned' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
        print_r($data);
        if ($data['assigned'] !== '') {
            $task->assigned_to_id = $data['assigned'];
        }
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->created_by_id = Auth::user()->id;
        $task->status_id = $data['status'];
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task) {
            $task->delete();
        }
        return redirect()->route('tasks.index');
    }
}
