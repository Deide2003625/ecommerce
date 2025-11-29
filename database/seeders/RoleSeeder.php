<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Super Admin', 'description' => 'Accès total à toutes les fonctionnalités et paramètres du système'],
            ['name' => 'Admin', 'description' => 'Gestion avancée du catalogue, commandes, clients et marketing'],
            ['name' => 'Gestionnaire', 'description' => 'Gestion de la boutique, produits, commandes et clients'],
            ['name' => 'Livreur', 'description' => 'Accès aux livraisons et suivi des commandes'],
            ['name' => 'Client', 'description' => 'Accès client pour achats et suivi de commandes'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                [
                    'name' => $role['name'],
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'description' => $role['description']
                ]
            );
        }
    }
}
