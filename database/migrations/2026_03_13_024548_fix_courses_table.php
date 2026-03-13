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
        //
        Schema::table('courses', function (Blueprint $table) {

            $table->renameColumn('CourseCode', 'course_code');
            $table->renameColumn('CourseName', 'course_name');
            $table->renameColumn('Description', 'description');
            $table->renameColumn('Credits', 'credits');
            $table->renameColumn('Semester', 'semester');
            $table->renameColumn('Year', 'year');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
