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
        Schema::table('admin', function (Blueprint $table) {
            $table->softDeletes();
            $table->uuid('created_by_admin_id')->nullable()->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('admin', function (Blueprint $table): void {
            $table->dropSoftDeletes();
            $table->dropColumn('created_by_admin_id');
        });
    }
};
