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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('CourseCode');
            $table->string('CourseName');
            $table->string('Description')->nullable();
            $table->integer('Credits');
            $table->foreignId(User::class)->constrained()->onDelete('cascade');
            $table->string('Semester');
            $table->string('Year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
