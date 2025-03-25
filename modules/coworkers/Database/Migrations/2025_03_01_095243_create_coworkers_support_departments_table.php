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
        Schema::create('coworker_support_department', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coworker_id');
            $table->unsignedBigInteger('support_department_id');
            $table->foreign('coworker_id')->references('id')->on('coworkers');
            $table->foreign('support_department_id')->references('id')->on('support_departments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coworker_support_department');
    }
};
