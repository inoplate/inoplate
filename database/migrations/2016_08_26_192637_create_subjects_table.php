<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('program_id')->nullable();
            $table->enum('type', [
                'w',
                'p',
                'wp',
                'pp',
                'ta'
            ])->nullable();

            $table->enum('group', [
                'mpk',
                'mkk',
                'mkb',
                'mpb',
                'mbb',
                'mku',
                'mkdk',
                'mkk'
            ])->nullable();
            
            $table->integer('sks_tm')->default(0);
            $table->integer('sks_p')->default(0);
            $table->integer('sks_pl')->default(0);
            $table->integer('sks_s')->default(0);
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
        Schema::drop('subjects');
    }
}
