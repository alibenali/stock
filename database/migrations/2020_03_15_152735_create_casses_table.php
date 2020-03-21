<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produit_id')->unsigned();
            $table->bigInteger('utilisateur_id')->unsigned();
            $table->string('quantite');
            $table->string('observation');
            $table->string('statut');
            $table->timestamps();
        });

        Schema::table('casses', function($table)
        {
            $table->foreign('produit_id')
                ->references('id')->on('produits');

            $table->foreign('utilisateur_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casses');
    }
}
