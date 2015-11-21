<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('feedback_id')->unsigned();
            $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('cascade');
            $table->integer('classification_id')->unsigned();
            $table->foreign('classification_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::drop('sentences');
    }
}
