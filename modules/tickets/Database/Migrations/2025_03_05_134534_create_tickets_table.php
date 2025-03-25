<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tickets\App\Enum\TicketStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('support_department_id');
            $table->boolean('is_opened')->default(0);
            $table->unsignedBigInteger('opened_by')->nullable()->comment('support coworker id');
            $table->enum('status', [TicketStatus::AWAITING_SUPPORT_RESPONSE->value, TicketStatus::UNDER_REVIEW->value, TicketStatus::RESPONDED->value])->default(TicketStatus::AWAITING_SUPPORT_RESPONSE->value);
            $table->enum('priority', [TicketStatus::URGENT->value, TicketStatus::IMPORTANT->value, TicketStatus::NORMAL->value]);
            $table->timestamp('closed_at')->nullable();
            $table->tinyInteger('satisfaction_rate')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('support_department_id')->references('id')->on('support_departments');
            $table->foreign('opened_by')->references('id')->on('coworkers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
