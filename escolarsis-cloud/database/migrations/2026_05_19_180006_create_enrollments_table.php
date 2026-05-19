<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('active'); // active, completed, withdrawn
            $table->date('enrolled_on')->nullable();
            $table->timestamps();

            $table->unique(
                ['organization_id', 'student_id', 'program_id', 'academic_year_id'],
                'enrollments_org_student_program_year_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
