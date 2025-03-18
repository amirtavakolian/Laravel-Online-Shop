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
        Schema::create('assign_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_coworker');
            $table->unsignedBigInteger('to_coworker')->nullable();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('support_department_id');
            $table->text('assign_reason');
            $table->foreign('from_coworker')->references('id')->on('coworkers');
            $table->foreign('to_coworker')->references('id')->on('coworkers');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('support_department_id')->references('id')->on('support_departments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_ticket');
    }
};
