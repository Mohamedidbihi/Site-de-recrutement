<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Titre');
            $table->string('Description');
            $table->foreign('secteur_id')->references('id')->on('secteurs')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('secteur_id')->unsigned()->index()->nullable();
            $table->foreign('diplome_id')->references('id')->on('diplomes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('diplome_id')->unsigned()->index()->nullable();
            $table->string("Niveau d'experience");
            $table->string('Etat')->default('en attente');
            $table->foreign('Typeoffre_id')->references('id')->on('TypeOffre')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('Typeoffre_id')->unsigned()->index()->nullable();
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('ville_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('offres');
    }
}
