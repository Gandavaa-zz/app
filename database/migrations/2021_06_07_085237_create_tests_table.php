<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('label', 755);
            $table->string('logo');
            $table->integer('price_in_credits');
            $table->timestamps();
        });

        // Schema::create('test_user', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('user_id');
        //     $table->unsignedBigInteger('test_id');
        //     $table->smallInteger('completed')->default(0);
        //     $table->timestamps();

        //     $table->foreign('user_id')
        //         ->references('id')->on('users')->onDelete('cascade')->onDelete('cascade');
        //     $table->foreign('test_id')
        //         ->references('id')->on('tests')->onDelete('cascade')->onDelete('cascade');
        // });

        // Schema::create('parts', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->UnsignedBigInteger('test_id');
        //     $table->integer('num');
        //     $table->string('title');
        //     $table->string('info');
        //     $table->timestamps();

        //     $table->foreign('test_id')
        //           ->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
        Schema::dropIfExists('test_user');
        Schema::dropIfExists('tests');
    }
}
