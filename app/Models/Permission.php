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

     public static function booted()
     {
        static::created(function($permission){
            $adminRole = Role::where('slug', 'admin')->first();
            if (!$adminRole->hasPermission($permission->id)) {
                $permission->roles()->attach($adminRole);
            }
        });

        static::updated(function($permission){
            $adminRole = Role::where('slug', 'admin')->first();
            if (!$adminRole->hasPermission($permission->id)) {
                $permission->roles()->attach($adminRole);
            }
        });
     }

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
