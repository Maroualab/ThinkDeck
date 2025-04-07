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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference user_id from workspace_user
            $table->unsignedBigInteger('workspace_id'); // Reference workspace_id from workspace_user
            $table->string('title');
            $table->text('content')->nullable();
            $table->timestamps();

            // Foreign key constraints for the composite key
            $table->foreign(['user_id', 'workspace_id'])
                ->references(['user_id', 'workspace_id'])
                ->on('workspace_user')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
