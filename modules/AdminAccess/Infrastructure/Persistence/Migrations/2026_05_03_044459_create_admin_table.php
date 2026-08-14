<?php
// php artisan make:migration create_roles_table --path=modules/AdminAccess/Infrastructure/Persistence/Migrations
// php artisan make:migration create_role_user_table --path=modules/AdminAccess/Infrastructure/Persistence/Migrations
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->timestamp('locked_until')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->default('active'); // active|suspended|locked
            $table->unsignedSmallInteger('failed_login_attempts')->default(0);
            $table->rememberToken();
            $table->timestamps();

            $table->index('email');
            $table->index('username');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};

// php artisan make:migration create_users_table --path=modules/AdminAccess/Infrastructure/Persistence/Migrations <--- start here