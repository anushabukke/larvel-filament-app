<?php

namespace App\Http\Controllers;

use App\Models\TaskManagement;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    public function index()
    {
        $tasks = TaskManagement::all();

        return view('task-managements.index', compact('tasks'));
    }

    public function create()
    {
        return view('task-managements.create');
    }

    public function store(Request $request)
    {
        // Validation and saving the new record
        TaskManagement::create($request->all());

        return redirect()->route('/task-managements');
    }

    // Other methods like edit, update, destroy, etc.
}
