<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("emails", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('template');
            $table->string('subject');
            $table->text('data')->nullable();
            $table->string('user_name');
            $table->string('user_email');
            $table->integer('status')->default(0);
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
        //
    }
}
