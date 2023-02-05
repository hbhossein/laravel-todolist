<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = $user->tasks()->orderBy('created_at', 'desc')->get();

        $users = [];
        if (Gate::allows('view-task')) {
            $users = User::all();
        }
        
        return view('dashboard', ['tasks' => $tasks, 'users' => $users]);
    }

    public function markAsComplete(Task $task)
    {
        if (Gate::allows('edit', $task)) {
            $task->is_complete = 1;
            $task->save();
        }

        return redirect('dashboard');
    }

    public function delete(Task $task)
    {
        if (Gate::allows('edit', $task)) {
            $task->delete();
        }

        return redirect('dashboard');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->user_id =  $request->user()->id;
        $task->save();
        return redirect('dashboard');
    }
}
