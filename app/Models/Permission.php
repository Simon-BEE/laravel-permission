<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * * METHODS
     */

    /**
     * Check if a permission has a role
     *
     * @param integer $roleId
     * @return boolean
     */
    public function hasRole(int $roleId): bool
    {
        return $this->roles->contains('id', $roleId);
    }

    /**
     * Set permission to role Admin
     * ! It must be mandatory
     *
     * @return void
     */
    public function setPermissionToAdmin(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        if (!$adminRole->hasPermission($this->id)) {
            $this->roles()->attach($adminRole);
        }
    }

    /**
     * * RELATIONSHIPS
     */

    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
