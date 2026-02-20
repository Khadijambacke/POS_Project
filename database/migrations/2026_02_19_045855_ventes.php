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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('produits_id');
            $table->integer('quantite');
            $table->decimal('prixunitaire', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->foreign('produits_id')->references('id')->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');  // enfant d'abord
       
    }
};
