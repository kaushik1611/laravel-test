<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin role.
        $admin = Role::where('name','admin')->get()->first();
        if(!$admin){
            $admin = Role::create([
                'name' => 'admin',
                'guard_name' => 'admin'
            ]);
        }
        //Bussiness-to-customer role.
        $b2cCustomer = Role::where('name','b2cCustomer')->get()->first();
        if(!$b2cCustomer){
            $b2cCustomer = Role::create([
                'name' => 'b2cCustomer',
                'guard_name' => 'customer',
            ]);
        }
        //Bussiness-to-bussiness role.
        $b2bCustomer = Role::where('name','b2bCustomer')->get()->first();
        if(!$b2bCustomer){
            $b2bCustomer = Role::create([
                'name' => 'b2bCustomer',
                'guard_name' => 'customer',
            ]);
        }
    }
}
