<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Backs IdempotentListener::onceFor(). Distinct from idempotency_keys:
     * idempotency_keys guards a *write path* against double-submission
     * (e.g. two identical "forgot password" clicks within the same
     * minute); processed_events guards a *listener* against redelivery of
     * an event it has already reacted to. Same underlying idea
     * (claim-then-act), different layer -- kept as two tables rather than
     * one so each can be reasoned about, indexed, and pruned independently.
     *
     * The unique index is on (idempotency_key, listener) rather than just
     * idempotency_key: several listeners can react to the same event, and
     * one listener claiming the key must not block a different listener
     * from also getting to run.
     */
    public function up(): void
    {
        Schema::create('processed_events', function (Blueprint $table) {
            $table->id();
            $table->string('idempotency_key');
            $table->string('listener');
            $table->timestamp('processed_at');

            $table->unique(['idempotency_key', 'listener']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processed_events');
    }
};
