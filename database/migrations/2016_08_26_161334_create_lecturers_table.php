<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('reg_no');
            $table->string('local_reg_no');
            $table->string('avatar');
            $table->enum('status', [
                'pns',
                'pnsb',
                'pnsd',
                'gtypty',
                'gttpttp',
                'gttpttk',
                'gbp',
                'ghs',
                'ths',
                'nonpns',
                'tni',
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
        Schema::drop('lecturers');
    }
}
