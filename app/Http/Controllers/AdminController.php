<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return inertia("Admin/Index", [
            "tasks" => Task::query()->latest()->filter(request(['status', 'order']))->paginate(10)->withQueryString(),
            "query" => request()->query()
        ]);
    }
}
