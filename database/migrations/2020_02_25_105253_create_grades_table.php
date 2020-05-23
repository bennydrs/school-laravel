<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_learn_id');
            $table->integer('semester_id');
            $table->integer('class_student_id');
            $table->integer('student_id');
            $table->integer('teacher_id');
            $table->char('nilai_tugas_1', 3);
            $table->char('nilai_tugas_2', 3);
            $table->char('nilai_uts', 3);
            $table->char('nilai_uas', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
