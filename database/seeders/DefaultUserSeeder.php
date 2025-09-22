<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        // Only create the user if they don't already exist
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'given_name' => 'Md Foysal',
                'surname' => 'Ahmed',
                'phone' => '0425779590',
                'type' => 'super',
                'address' => '86 HighClere Ave, Punchbowl NSW 2196',
                'email' => 'ahmedfoysal101@gmail.com',
                'password' => Hash::make('password'), // Use a strong password in production!
                // Add 'is_admin' => true if your app has admin logic
            ]);
        }
    }
}
