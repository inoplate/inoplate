<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('reg_no');
            $table->string('program_id');
            $table->string('entry_year');
            $table->string('avatar');
            $table->enum('status', [
                'active',
                'graduated',
                'mutation',
                'do',
                'resign',
                'leave',
                'die',
                'lost',
                'other'
            ]);
            $table->string('id_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('country_id')->nullable();
            $table->string('religion_id')->nullable();
            $table->enum('gender', ['m', 'f'])->nullable();
            $table->string('mother_maiden_name')->nullable();
            $table->string('user_id');
            $table->softDeletes();
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
        Schema::drop('students');
    }
}
