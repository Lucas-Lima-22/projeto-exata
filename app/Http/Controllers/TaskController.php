<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        return inertia("Tasks/Index", [
            "tasks" => Task::query()->latest()->filter(request(['status', 'order']))->paginate(10)->withQueryString(),
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
            "title"       => ['required', "string"],
            "description" => ['required', "string", "max:200"],
            "status"      => ['required', Rule::enum(TaskStatus::class)],
        ]);

        $validated["user_id"] = auth()->id();

        Task::create($validated);

        return redirect('/')->with("message", "Your task has been created successfully.");
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
            "title"       => ['required', "string"],
            "description" => ['required', "string", "max:200"],
            "status"      => ['required', Rule::enum(TaskStatus::class)],
        ]);

        $task->update($validated);

        return redirect('/tasks/' . $task->id)->with("message", "Your task has been updated successfully.");
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect("/")->with("message", "Your task has been deleted successfully.");
    }
}
