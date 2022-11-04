<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'phone' => '0248907444',
            'showroom' => 'Head Office',
            'password' => bcrypt('12345678')
        ]);
    
        $role = Role::where('name', 'Admin')->first();
        // $role = Role::create(['name'=> 'Admin'])->first();
     
        $permissions = Permission::pluck('id','id')->all();
         
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}