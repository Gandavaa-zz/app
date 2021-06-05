<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('user_answers', function (Blueprint $table) {
    //         $table->bigIncrements('id');
    //         $table->UnsignedBigInteger('user_id');
    //         $table->UnsignedBigInteger('quiz_id');
    //         $table->integer('answer_number');
    //         $table->timestamps();

    //         $table->foreign('user_id')
    //             ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

    //         $table->foreign('quiz_id')
    //             ->references('id')->on('quizzes')->onDelete('cascade')->onUpdate('cascade');
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('user_answers');
    // }
}
