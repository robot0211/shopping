<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Khi xóa Role, các bản ghi liên quan trong permission_role cũng bị xóa
        static::deleting(function ($role) {
            $role->permissions()->detach();
        });
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

}
