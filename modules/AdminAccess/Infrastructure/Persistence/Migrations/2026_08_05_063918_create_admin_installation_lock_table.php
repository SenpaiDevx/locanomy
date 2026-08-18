<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
  
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_installation_lock', function (Blueprint $table) {
            $table->id();
            $table->timestamp('installed_at')->nullable();
            $table->foreignUuid('installed_by_admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });

        Db::table('admin_installation_lock')->insert(['id' => 1]); // <- claim installation logic see at 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_installation_lock');
    }
};
