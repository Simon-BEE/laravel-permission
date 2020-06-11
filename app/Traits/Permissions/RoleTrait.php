<?php

namespace App\Traits\Permissions;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait RoleTrait
{
    /**
     * Check if an user has some roles
     *
     * @param string ...$roles
     * @return boolean
     */
   public function hasRoles(string ...$roles): bool
   {
       foreach ($roles as $role) {
           if ($this->roles->contains('slug', $role)) {
               return true;
           }
       }
       return false;
   }

   /**
    * Give role not already added to an user
    *
    * @param string ...$roles
    * @return void
    */
   public function giveRolesTo(string ...$roles): void
   {
       $this->roles()->attach($this->getNewRolesRequested($roles));
   }

   /**
    * Remove role not already added to an user
    *
    * @param string ...$roles
    * @return void
    */
   public function removeRolesTo(string ...$roles): void
   {
       $this->roles()->detach($this->getOldRolesRequested($roles));
   }
    /**
     * Get roles not already added and requested if exists
     *
     * @param array $roles
     * @return Collection
     */
    private function getNewRolesRequested(array $roles): Collection
    {
        $filteredRolesRequested = $this->getRolesRequested($roles)->reject(function ($role){
            return $this->hasRoles($role);
        });

        throw_if($filteredRolesRequested->isEmpty(), \Exception::class ,'No roles found');

        return $filteredRolesRequested;
    }

    /**
     * Get roles already added and requested if exists
     *
     * @param array $roles
     * @return Collection
     */
    private function getOldRolesRequested(array $roles): Collection
    {
        $filteredRolesRequested = $this->getRolesRequested($roles)->reject(function ($role){
            return !$this->hasRoles($role);
        });

        throw_if($filteredRolesRequested->isEmpty(), \Exception::class ,'No roles found');

        return $filteredRolesRequested;
    }

    /**
     * Get all roles requested if exists
     *
     * @param array $roles
     * @return Collection
     */
    private function getRolesRequested(array $roles): Collection
    {
        $rolesRequested = Role::whereIn('slug', $roles)->get();

        throw_if($rolesRequested->isEmpty(), \Exception::class ,'No roles found');

        return $rolesRequested;
    }
}
