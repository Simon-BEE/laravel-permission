<?php

namespace App\Traits\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

trait PermissionTrait
{
    /**
     * Check if an user has permission to do an action
     *
     * @param Permission $permission Permission's slug
     * @return boolean
     */
    public function hasPermissionTo(Permission $permission): bool
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    /**
     * Give permission not already added to an user
     *
     * @param string ...$permissions
     * @return void
     */
    public function givePermissionsTo(string ...$permissions): void
    {
        $this->permissions()->attach($this->getNewPermissionsRequested($permissions));
    }

    /**
     * Remove permission not already added to an user
     *
     * @param string ...$permissions
     * @return void
     */
    public function removePermissionsTo(string ...$permissions): void
    {
        $this->permissions()->detach($this->getOldPermissionsRequested($permissions));
    }
    /**
     * Check if an user has permission to do something through his permissions
     *
     * @param Permission $permission Permission's slug
     * @return boolean
     */
    private function hasPermission(Permission $permission): bool
    {
        return $this->permissions
            ->contains('slug', $permission->slug)
        ;
    }

    /**
     * Check if an user has permission to do something through his role
     *
     * @param Permission $permission
     * @return boolean
     */
    private function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all permissions requested if exists
     *
     * @param array $permissions
     * @return Collection
     */
    private function getPermissionsRequested(array $permissions): Collection
    {
        $permissionsRequested = Permission::whereIn('slug', $permissions)->get();

        throw_if($permissionsRequested->isEmpty(), \Exception::class ,'No permissions found');

        return $permissionsRequested;
    }

    /**
     * Get permissions not already added and requested if exists
     *
     * @param array $permissions
     * @return Collection
     */
    private function getNewPermissionsRequested(array $permissions): Collection
    {
        $filteredPermissionsRequested = $this->getPermissionsRequested($permissions)->reject(function ($permission){
            return $this->hasPermissionTo($permission);
        });

        throw_if($filteredPermissionsRequested->isEmpty(), \Exception::class ,'No permissions found');

        return $filteredPermissionsRequested;
    }

    /**
     * Get permissions already added and requested if exists
     *
     * @param array $permissions
     * @return Collection
     */
    private function getOldPermissionsRequested(array $permissions): Collection
    {
        $filteredPermissionsRequested = $this->getPermissionsRequested($permissions)->reject(function ($permission){
            return !$this->hasPermissionTo($permission);
        });

        throw_if($filteredPermissionsRequested->isEmpty(), \Exception::class ,'No permissions found');

        return $filteredPermissionsRequested;
    }
}
