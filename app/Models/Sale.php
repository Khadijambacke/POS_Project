<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    protected $fillable = [
        'users_id',
        'total',
        'montant_recu',
        'monnaie',
        'modepaiement'
    ];

    public function ventes() {
        return $this->hasMany(Vente::class, 'sales_id');
    }
    public function caissier() {
        return $this->belongsTo(User::class, 'users_id');
    }
    

}
