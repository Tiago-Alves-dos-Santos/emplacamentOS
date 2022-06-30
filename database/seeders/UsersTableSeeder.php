<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => mb_strtoupper("youser"),
            'email' => "masterdev@email.com",
            'password' => Hash::make("masterdevs"),
            'type' => 'admin',
            'active' => 'Y',
        ]);
    }
}
