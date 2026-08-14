<?php
// php artisan make:migration create_permissions_table --path=modules/Users/Database/Migrations
// php artisan make:migration create_permission_role_table --path=modules/Users/Database/Migrations
namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
 
class Permission extends SpatiePermission
{
    use HasUlids, HasFactory;

    protected $table = 'permissions'; // permissions
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name', 'group', 'description'];
}

