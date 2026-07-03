<?php
// php artisan make:migration create_roles_table --path=modules/Users/Database/Migrations
// php artisan make:migration create_role_user_table --path=modules/Users/Database/Migrations
namespace Modules\AdminAccess\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
class Role extends SpatieRole
{

    use HasUlids, HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'display_name', 'description', 'is_default'];
    protected $casts = ['is_default' => 'boolean'];

    // public function usersObj()
    // {
    //     return $this->belongsToMany(UserModel::class, 'role_user', 'user_id', 'role_id');
    // }

    // public function permissionsObj()
    // {
    //     return $this->belongsToMany(RoleModel::class, 'permissions', 'permission_id', 'role_id')
    //     ->withTimestamps();
    // }

}

