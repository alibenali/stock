<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatingProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fournisseur_id')->unsigned();
            $table->bigInteger('famille_id')->unsigned();
            $table->string('designation');
            $table->double('colis');
            $table->integer('nbr_colis');
            $table->double('quantite');
            $table->double('prix_achat');
            $table->timestamps();

        });

        Schema::table('produits', function($table)
        {
            $table->foreign('fournisseur_id')
                ->references('id')->on('fournisseurs');

            $table->foreign('famille_id')
                ->references('id')->on('familles');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
