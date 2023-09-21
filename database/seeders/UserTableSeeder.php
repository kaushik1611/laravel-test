<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user =  User::create(
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
        // $user->assignRole('admin');

        Customer::create(
            [
                'name'=>'John',
                'email'=>'john@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name'=>'Santos',
                'email'=>'santos@gmail.com',
                'password' => Hash::make('12345678')
            ]
        );
    }
}
