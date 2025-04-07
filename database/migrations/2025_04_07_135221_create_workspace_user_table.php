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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('workspace_id'); // Define workspace_id as an unsigned big integer
            $table->foreign('workspace_id')->references('workspace_id')->on('workspaces')->onDelete('cascade'); // Explicitly reference workspace_id
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
