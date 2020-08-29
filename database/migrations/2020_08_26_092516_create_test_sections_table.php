<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('test_id');
            $table->integer('num');
            $table->string('title');
            $table->string('info');
            $table->integer('start');
            $table->integer('end');
            $table->timestamps();

            $table->foreign('test_id')
                  ->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_sections');
    }
}
