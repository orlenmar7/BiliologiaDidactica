<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetterSoupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_soups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('history_id')->unsigned();
            //$table->string('slug');
            $table->text('words');
            $table->timestamps();

            $table->foreign('history_id')
                ->references('id')
                ->on('histories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letter_soups');
    }
}
