<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::updateOrCreate(
            [
                'email' => 'ahmedfoysal101@gmail.com',
            ],
            [
                'given_name' => 'Ahmed',
                'surname' => 'Foysal',
                'role' => 'super',
                'address' => '123 Demo Street, Demo City',
                'type' => 'admin',
                'phone' => '0000000000',
                'password' => Hash::make('password'),
            ]
        );
        $this->command->info('Super user created: ' . $user->email);
    }
}