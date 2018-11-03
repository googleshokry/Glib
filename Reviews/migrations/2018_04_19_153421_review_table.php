<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("model_id")->index();
            $table->string("model");
            $table->float("rate")->default(0);
            $table->text("comment");
            $table->tinyInteger("status")->default(\Glib\Models\Review::status['active']);
            $table->integer("user_id")->index();
            $table->string("user");
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
        Schema::dropIfExists("reviews");
    }
}
