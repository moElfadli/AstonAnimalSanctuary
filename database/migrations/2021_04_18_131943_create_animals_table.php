<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('userid') ->unsigned(); 
            $table ->foreign('userid')->references('id')->on('users'); 

            $table->string('name');
            $table->Date('DOB');
            $table->text('description');
            $table->string('pendingUsers'); 
            $table->string('deniedUsers'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
