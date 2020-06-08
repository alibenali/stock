<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFamilleIdToCaisse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caisse', function (Blueprint $table) {
            $table->bigInteger('famille_id')->unsigned()->nullable()->after('id');

        });

        Schema::table('caisse', function (Blueprint $table) {
            $table->foreign('famille_id')->references('id')->on('caisse_familles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caisse', function (Blueprint $table) {
            $table->dropForeign(['famille_id']);
            $table->dropColumn('famille_id');
        });
    }
}
