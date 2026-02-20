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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id'); 
            $table->decimal('total', 10, 2);
            $table->decimal('montant_recu', 10, 2);
            $table->decimal('monnaie', 10, 2)->default(0);
            $table->enum('modepaiement', ['especes', 'carte', 'cheque'])->default('especes');
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
        Schema::dropIfExists('sales');
    }
};
