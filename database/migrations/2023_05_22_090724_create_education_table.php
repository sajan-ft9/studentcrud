<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
 
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('level');
            $table->string('college');
            $table->string('university');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('education');
    }
};
