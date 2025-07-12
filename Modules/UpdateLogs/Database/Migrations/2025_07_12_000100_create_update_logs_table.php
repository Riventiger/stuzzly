<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('update_logs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('deployed'); // deployed | pending | failed | rolled_back
            $table->string('type')->nullable(); // ai | manual | patch | upgrade
            $table->string('source')->nullable(); // gpt | claude | user | system
            $table->string('author')->nullable(); // user or AI label
            $table->timestamp('deployed_at')->nullable();
            $table->string('rollback_token')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('update_logs');
    }
};
