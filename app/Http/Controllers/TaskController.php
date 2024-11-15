<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return inertia("Index", [
            "tasks" => Task::get()
        ]);
    }

    public function create()
    {
        return inertia('Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => ['required'],
            "description" => ['required'],
            "status" => ['required'],
        ]);

        Task::create($validated);

        return redirect('/');
    }

    public function show(Task $task)
    {
        return inertia("Show", [
            "task" => $task
        ]);
    }

    public function edit(Task $task)
    {
        return inertia("Edit", [
            "task" => $task
        ]);
    }

    public function update(Task $task, Request $request)
    {
        $validated = $request->validate([
            "title" => ['required'],
            "description" => ['required'],
            "status" => ['required'],
        ]);

        $task->update($validated);

        return redirect('/tasks/' . $task->id);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect("/");
    }
}
