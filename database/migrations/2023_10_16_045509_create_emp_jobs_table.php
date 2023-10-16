<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emp_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('emp_job');
            $table->string('emp_companyn');
            $table->date('emp_fromec');
            $table->date('emp_toc');
            $table->string('emp_contactc');
            $table->string('emp_addressc');
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_jobs');
    }
};
