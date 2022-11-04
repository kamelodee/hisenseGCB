<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'Show Roles',
           'Create Role',
           'Edit Role',
           'Delete Role',

           'Show Users',
           'Create User',
           'Edit User',
           'Delete User',

           'Show Showrooms',
           'Create Showroom',
           'Edit Showroom',
           'Delete Showroom',

           'Show Transactions',
           'Create Transaction',
           'Edit Transaction',
           'Delete Transaction',

           'Show Payments',
           'Create Payment',
           'Edit Payment',
           'make Payment',
           'Delete Payment',
           'Access All',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}