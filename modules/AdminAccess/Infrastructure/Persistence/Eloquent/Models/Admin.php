<?php
// php artisan make:migration create_users_table --path=modules/Users/Database/Migrations
// php artisan make:migration create_role_user_table --path=modules/Users/Database/Migrations

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\AdminFactory;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]

final class Admin extends Model implements AuthenticatableContract
{
    /** @use HasFactory<AdminFactory> */
    use Authenticatable, HasFactory, HasUuids, HasApiTokens, HasRoles, Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    protected $guard_name = 'web';
    protected $fillable = [
        'id',
        'name',
        'email',
        'status',
        'username',
        'password',
        'locked_until',
        'email_verified_at',
        'created_by_admin_id',
        'failed_login_attempts',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'locked_until' => 'immutable_datetime',
        'email_verified_at' => 'immutable_datetime',
        'failed_login_attempts' => 'integer',

    ];

    public function passwordHistories() : HasMany
    {
        return $this->hasMany(PasswordHistory::class, "admin_id");
    }
}