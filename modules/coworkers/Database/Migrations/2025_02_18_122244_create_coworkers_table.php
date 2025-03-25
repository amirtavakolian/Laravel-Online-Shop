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
        Schema::create('coworkers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('birthday_date');
            $table->timestamp('establish_date')->useCurrent();
            $table->string('mobile')->unique();
            $table->string('password', 150);
            $table->boolean('marriage_status');
            $table->tinyInteger('children_count')->default(0);
            $table->enum('gender', ['woman', 'man']);
            $table->string('emergency_number');
            $table->string('position', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coworkers');
    }
};
