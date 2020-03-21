<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produit_id')->unsigned();
            $table->bigInteger('fournisseur_id')->unsigned();
            $table->double('quantite');
            $table->double('prix_achat');
            $table->string('statut');
            $table->timestamps();
        });

        Schema::table('achats', function($table)
        {
            $table->foreign('produit_id')
                ->references('id')->on('produits');

            $table->foreign('fournisseur_id')
                ->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achats');
    }
}
