<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_id');

            $table->string('nom');
            $table->string('code_barre')->unique()->nullable(); 
            $table->text('description');
            $table->decimal('prixappro', 10, 2);                     
            $table->decimal('prix_vente', 10, 2)->default(0);   
            $table->integer('qtestock');          
            $table->string('image')->nullable();
            $table->enum('statut', ['disponible', 'enrupture'])->default('disponible');
            $table->timestamps();
            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            
        });
    }
};
