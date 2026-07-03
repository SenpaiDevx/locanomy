<?php
// php artisan make:migration create_users_table --path=modules/Users/Database/Migrations
// php artisan make:migration create_role_user_table --path=modules/Users/Database/Migrations
namespace Modules\AdminAccess\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Modules\AdminAccess\Concerns\HasUserProfile; // this traits modules 

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable {

    /** @use HasFactory<UserFactory> */
    use HasUlids, HasFactory, HasApiTokens, HasRoles, Notifiable,
    HasUserProfile;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'avatar',
        'timezone',
        'locale',
        'last_login_ip',
        'last_login_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',   
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles()
    {
        $this->getProfileAttribute();
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
        ->withTimestamps();
    }

    // public function profile()
    // {
    //     return $this->hasOne(UserProfile::class);
    // }

    // public function getProfileAttribute()
    // {
    //     return $this->profile()->firstOrCreate();
    // }


}

