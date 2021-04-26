<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('userid') ->unsigned();
            $table->bigInteger('animalid') ->unsigned(); 
            $table ->foreign('userid')->references('id')->on('users'); 
            $table ->foreign('animalid')->references('id')->on('animals');
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
        Schema::dropIfExists('adoption_requests');
    }
}
