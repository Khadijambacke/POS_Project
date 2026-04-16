<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Produit;

class DeemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create([ 
            'name' => 'Admin', 
            'email' => 'admin@test.com', 
            'role' => 'admin', 
            'password' => bcrypt('admin123') 
                ]); 
                User::create([ 
                    'name' => 'khadija', 
                    'email' => 'khadija@test.com', 
                    'role' => 'caissier', 
                    'password' => bcrypt('caisse123') 
                        ]); 

                Categorie::create([
                    'nom'         => 'Boissons',
                    'description' => 'Boissons gazeuses',
                    
                ]);
                Produit::create([
                    'categories_id' => 1,           
                    'nom'           => 'Coca Cola',
                    'code_barre'    => '5554',
                    'description'   => 'Coca Cola 1.5L',
                    'prixappro'     => 500,          
                    'prix_vente'    => 900,          
                    'qtestock'      => 50,
                    'statut'        => 'disponible'
                ]);
    }
}
