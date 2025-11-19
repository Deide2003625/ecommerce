<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'phone' => '1234567890',
                'is_active' => true,
                'password' => Hash::make('password'), // password
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone'=> '0987654321',
                'is_active' => true,
                'password' => Hash::make('password'), // password
            ],
            [
                'name' => 'Gestionnaire',
                'email' => 'gestionnaire@gmail.com',
                'phone'=> '1234567890',
                'is_active'=> true,
                'password' => Hash::make('password'), // password
            ],
            [
                'name' => 'Livreur',
                'email' => 'livreur@gmail.com',
                'phone'=> '0987654321',
                'is_active' => true,
                'password' => Hash::make('password'), // password
            ],
            [
                'name' => 'Client',
                'email' => 'client@gmail.com',
                'phone'=> '1234567890',
                'is_active' => true,
                'password' => Hash::make('password'), // password
            ],
        ];

        foreach ($users as $user) {
            $user = User::create($user);
            // Assign roles to users
            if ($user->email === 'superadmin@gmail.com') {
                $user->assignRole('Super Admin');
            } elseif ($user->email === 'admin@gmail.com') {
                $user->assignRole('Admin');
            } elseif ($user->email === 'gestionnaire@gmail.com') {
                $user->assignRole('Gestionnaire');
            } elseif ($user->email === 'livreur@gmail.com') {
                $user->assignRole('Livreur');
            } else{
                $user->assignRole('Client');
            }
        }
    }
}
