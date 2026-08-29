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
        Schema::create('teacher_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            $table->foreignId('instrument_id')
                ->constrained('instruments')
                ->cascadeOnDelete();

            // NOTE: ماژول courses هنوز ساخته نشده. این فیلد فعلاً بدون Foreign Key
            // Constraint نگه داشته می‌شود تا migration خطا ندهد. به محض ساخت جدول
            // courses، یک migration جدا برای اضافه‌کردن constraint اجرا می‌شود.
            $table->unsignedBigInteger('course_id')->nullable();

            $table->string('level', 50)->nullable();

            $table->timestamps();

            $table->unique(['teacher_id', 'instrument_id', 'course_id'], 'teacher_skills_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_skills');
    }
};
