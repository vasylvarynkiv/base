<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creator = User::create([
            'first_name' => 'Creator',
            'last_name' => 'Second',
            'email' => 'creator@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => 1,
        ]);
        $creator->assignRole([2]);

        $moderator = User::create([
            'first_name' => 'Moderator',
            'last_name' => 'One',
            'email' => 'moderator@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => 1,
        ]);
        $moderator->assignRole([3]);

    }
}
