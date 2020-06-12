<?php

namespace App\Repository;

use App\Models\Role;
use App\Models\User;

class UserRepository
{
    /**
     * Set different roles to user
     *
     * @param User $user
     * @param array $roles
     * @return User
     */
    public function setRolesRelationship(User $user, array $roles): User
    {
        if (in_array('admin' , $roles)) {
            $user->roles()->sync(Role::where('slug', 'admin')->first());
        }else{
            $user->giveRolesTo($roles);
            $user->load('roles');
        }

        return $user;
    }

    /**
     * Set rest of permissions to user
     *
     * @param User $user
     * @param array $permissions
     * @return User
     */
    public function setPermissionsRelationship(User $user, array $permissions): User
    {
        $user->load('permissions');
        $user->givePermissionsTo($permissions);

        return $user;
    }

    /**
     * Detach all roles and permissions of a user
     *
     * @param User $user
     * @return void
     */
    public function resetAuthRelationship(User $user): void
    {
        $user->roles()->detach();
        $user->permissions()->detach();
    }
}
