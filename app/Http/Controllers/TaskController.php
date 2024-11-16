<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return inertia("Tasks/Index", [
            "tasks" => Task::query()->filter(request(['status', 'order']))->paginate(10)->withQueryString(),
            "query" => request()->query()
        ]);
    }

    public function create()
    {
        return inertia('Tasks/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"       => ['required'],
            "description" => ['required'],
            "status"      => ['required'],
        ]);

        $validated["user_id"] = auth()->id();

        Task::create($validated);

        return redirect('/');
    }

    public function show(Task $task)
    {
        return inertia("Tasks/Show", [
            "task" => $task
        ]);
    }

    public function edit(Task $task)
    {
        return inertia("Tasks/Edit", [
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
