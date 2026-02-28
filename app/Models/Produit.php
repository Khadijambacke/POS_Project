<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    
    protected $fillable = [
     'categories_id',  
        'nom',          
        'code_barre',     
        'description',   
        'prixappro',      
        'prix_vente',     
        'qtestock',       
        'image',         
        'statut'          
    ];
    public function categorie() {
        return $this->belongsTo(Categorie::class ,foreignKey: 'categories_id');
    }
    public function ventes() {
        return $this->hasMany(Vente::class, 'produits_id');
    }

}
