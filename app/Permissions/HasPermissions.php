<?php

namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

trait HasPermissions {

    public function givePermission($user, $permission)
    {
        if (!Gate::allows('give-permission')) abort(403, 'You do not have permission to do this');

        if ($permission != null) {
            $user->permissions()->save($permission);
        }
        return $user;
    }

    public function giveRole($email, $role)
    {
        if (!Gate::allows('give-role')) abort(403, 'You do not have permission to do this');

        $role = Role::where('name', $role)->first();
        $user = $this->getUser($email);

        if ($role != null) {
            $user->roles()->save($role);
        }

        return $user;
    }

    public function withdrawPermission($user, $permission)
    {
        if (!Gate::allows('give-permission')) abort(403, 'You do not have permission to do this');

        $user->permissions()->detach($permission);
        return $user;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role) ? true : false;
    }

    protected function hasPermissionThroughRole($permission)
    {   
        foreach ($permission->roles as $role) {
            if ($this->roles->contains('name', $role->name)) {
                return true;
            }
        }
        return false;
    }

    protected function hasPermission($permission) 
    {
        return (bool) $this->permissions()->where('name', $permission->name)->count();
    }

    protected function getUser($email) 
    {
        return User::where('email', $email)->first();
    }
}