<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * RELATIONSHIPS
     */

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
