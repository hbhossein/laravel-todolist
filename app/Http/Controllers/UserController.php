<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->get();

        return view('tasks', ['tasks' => $tasks, 'user' => $user]);
    }

    public function delete(User $user)
    {
        if (Gate::allows('delete-user')) {
            $user->delete();
        }
        return redirect('dashboard');
    }

    public function create(User $user)
    {
        if (!Gate::allows('give-permission')) abort(403);

        $grantedPermissions = $user->permissions()->get();
        $permissions = Permission::WhereNotIn('id', $grantedPermissions->pluck('id'))->get();

        return  view('permission', [
            'permissions' => $permissions, 
            'grantedPermissions' => $grantedPermissions,
            'user' => $user]);
    }

    public function give(User $user, Permission $permission)
    {
        auth()->user()->givePermission($user, $permission);
        return redirect(route('givePermission', $user));
    }

    public function withdraw(User $user, Permission $permission)
    {
        auth()->user()->withdrawPermission($user, $permission);
        return redirect(route('givePermission', $user));
    }
}
