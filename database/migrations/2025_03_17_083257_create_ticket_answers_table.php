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
        Schema::create('ticket_answers', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('support_coworker_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');;
            $table->foreign('support_coworker_id')->references('id')->on('coworkers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_answers');
    }
};
