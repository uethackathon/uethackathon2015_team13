<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('content');
            $table->decimal('probability_positive', 6, 3);
            $table->decimal('probability_negative', 6, 3);
            $table->decimal('probability_neutral', 6, 3);
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('visibility_id')->unsigned();
            $table->foreign('visibility_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::drop('feedbacks');
    }
}
