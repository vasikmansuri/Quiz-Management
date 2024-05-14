<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'=>1,
            'username'=>'admin',
            'password'=>Hash::make('123456'),
            'email' => "admin@gmail.com",
            'first_name' => 'admin',
            'last_name' => 'admin'
        ]);

        UserRole::create([
            'role_name'=>'admin',
            'user_id'=>1
        ]);
    }
}
