<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('civilite')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->date('dn')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephoned');
            $table->string('adresse')->nullable();
            $table->bigInteger('region_id')->unsigned()->index()->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('ville_id')->unsigned()->index()->nullable();
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('diplome_id')->unsigned()->index()->nullable();
            $table->foreign('diplome_id')->references('id')->on('diplomes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('secteur_id')->unsigned()->index()->nullable();
            $table->foreign('secteur_id')->references('id')->on('secteurs')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('metier_id')->unsigned()->index()->nullable();
            $table->foreign('metier_id')->references('id')->on('metiers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('filecv')->nullable();

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
        Schema::dropIfExists('candidats');
    }
}
