<?php

namespace App\Http\Controllers;

use App\Models\MyTask;
use Illuminate\Http\Request;

class MyTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending_tasks = MyTask::where('status', 'pending')->get();
        $progress_tasks = MyTask::where('status', 'progress')->get();
        $complete_tasks = MyTask::where('status', 'complete')->get();

        return view('tasks.index', compact('pending_tasks', 'progress_tasks', 'complete_tasks'));
    }

    public function store(Request $request)
    {
        MyTask::create([
            'name' => $request->name,
            'status' => 'pending',
        ]);

        return redirect('/');
    }

    public function update(Request $request, MyTask $task)
    {
        $task->update([
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Task updated successfully']);
    }
}
