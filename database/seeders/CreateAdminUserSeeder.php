<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Nacer',
            'email' => 'nacer@gmail.com',
            'password' => bcrypt('nacer@gmail.com'),
            'roles_name' => ['admin'],
            'Status' => 'Active',
            ]);
            $role = Role::create(['name' => 'admin']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        
    }
}


