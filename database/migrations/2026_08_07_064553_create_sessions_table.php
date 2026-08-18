<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('sessions', function (Blueprint $table): void {
            $table->string('id')->primary();
            // Nullable, unsigned-agnostic string rather than
            // foreignId(): this table is shared across guards ('web'
            // for App\Models\User, 'admin' for AdminModel), and
            // AdminModel's primary key is a UUID string (see
            // Infrastructure\Persistence\Eloquent\Models\AdminModel),
            // not an auto-increment integer — a single foreignId
            // column couldn't hold both id types.
            $table->string('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table): void {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
    }
};
