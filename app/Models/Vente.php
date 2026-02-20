<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'sales_id',
        'produits_id',
        'quantite',
        'prixunitaire',
        'total'
    ];
    public function sale() {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

   
    public function produit() {
        return $this->belongsTo(Produit::class, 'produits_id');
    }
}
