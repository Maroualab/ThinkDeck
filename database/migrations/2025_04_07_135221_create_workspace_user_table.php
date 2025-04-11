<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('workspace_user', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->constrained('users')->onDelete('cascade');
            $table->foreignId('workspace_id')->references('id')->constrained('workspaces')->onDelete('cascade');
            $table->timestamp('joined_at');
            $table->primary(['user_id', 'workspace_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace_user');
    }
};
