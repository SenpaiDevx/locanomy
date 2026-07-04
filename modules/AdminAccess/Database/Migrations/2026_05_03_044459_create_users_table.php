<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('avatar')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('username');
            $table->index('is_active');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary()->unique();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUlid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->foreignUlid('user_id')->constrained('users')->cascadeOnDelete();
        });

         Schema::create('user_settings', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('two_factor_auth')->default(false);
            $table->json('notification_preferences')->nullable();
            $table->timestamps();
            
            $table->foreignUlid('user_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('user_settings');
        Schema::dropIfExists('password_reset_tokens');
    }
};

// php artisan make:migration create_users_table --path=modules/Users/Database/Migrations <--- start here