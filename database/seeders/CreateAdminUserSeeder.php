<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([ 
            'name' => 'cyborg',  
            'email' => 'cyborg@yopmail.com', 
            'password' => bcrypt('12345678') 
        ]); 
     
        $role = Role::create(['name' => 'Admin']); 
      
        $permissions = Permission::pluck('id','id')->all(); 
    
        $role->syncPermissions($permissions); 
      
        $user->assignRole([$role->id]); 
    }
}