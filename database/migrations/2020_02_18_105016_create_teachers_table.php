<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nrg', 10);
            // $table->char('nip', 10);
            $table->integer('user_id');
            $table->string('nama');
            $table->string('tempat_lahir', 128);
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin');
            $table->string('agama', 100);
            $table->char('telp', 15);
            $table->text('alamat');
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
        Schema::dropIfExists('teachers');
    }
}
