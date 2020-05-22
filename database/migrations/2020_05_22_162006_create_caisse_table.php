<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaisseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caisse', function (Blueprint $table) {
            $table->id();
            $table->string('objectif');
            $table->string('type');
            $table->integer('responsable_id')->unsigned();
            $table->integer('montant')->unsigned();
            $table->double('caisse_avant');
            $table->double('caisse_apres');
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
        Schema::dropIfExists('caisse');
    }
}
