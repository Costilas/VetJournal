<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateProjectRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $devPemissions = [
            'see devs',
            'edit devs'
        ];
        $adminPermissions = [
            'use admin panel',
            'add users',
            'edit users',
            'change user status',
            'make promotions'
        ];
        $doctorPermissions = [
            'create notes',
            'delete notes',
            'create cards',
            'edit owner',
            'add pet',
            'edit pet',
            'create visit',
            'edit visit',
        ];

        $allPermissions = array_merge($devPemissions, $adminPermissions, $doctorPermissions);

        foreach ($allPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        //Creating role "dev" and assigning permissions to the "dev" role
        Role::create([
            'name' => 'dev',
            'translate' => 'Разработчик',
        ])->syncPermissions($allPermissions);


        //Creating role "admin" and assigning permissions to the "admin" role
        Role::create([
            'name' => 'admin',
            'translate' => 'Администратор',
        ])->syncPermissions($adminPermissions);

        //Creating role "doctor" and assigning permissions to the "doctor" role
        Role::create([
            'name' => 'doctor',
            'translate' => 'Врач',
        ])->syncPermissions($doctorPermissions);

        //Assigning roles to users
            //Dev
        $dev = User::find(1);
        $dev->assignRole('dev');
            //Admin
        $admin = User::find(2);
        $admin->assignRole('admin');
            //Doctor
        $doctors = User::whereNotIn('id', [1])->get();
        foreach ($doctors as $doctor)
        {
            $doctor->assignRole('doctor');
        }
    }
}
