<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * The storefront/customer side of this application — deliberately a
 * completely separate model, table, and auth guard ('web', see
 * config/auth.php) from Modules\AdminAccess\...\AdminModel ('admin'
 * guard). Kept in app/Models rather than a module: this project's
 * merge scope was the AdminAccess module specifically (see
 * CHANGELOG.md); a real Catalog/Orders/Customers module boundary for
 * the storefront side is a separate piece of work this merge doesn't
 * attempt to invent.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }
}