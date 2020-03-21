<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produit_id')->unsigned();
            $table->double('quantite');
            $table->double('nbr_boites');
            $table->double('prix_unite');
            $table->double('prix_total');
            $table->string('nom_acheteur');
            $table->bigInteger('vendeur_id')->unsigned();
            $table->string('statut');
            $table->timestamps();
        });

        Schema::table('ventes', function($table)
        {
            $table->foreign('produit_id')
                ->references('id')->on('produits');

            $table->foreign('vendeur_id')
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
        Schema::dropIfExists('ventes');
    }
}
