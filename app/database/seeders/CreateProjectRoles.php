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
        //Dev
        Permission::create(['name'=>'see devs']);

        //Admin&Dev Side
        Permission::create(['name'=>'use admin panel']);
        Permission::create(['name'=>'add users']);
        Permission::create(['name'=>'edit users']);
        Permission::create(['name'=>'change user status']);
        Permission::create(['name'=>'make promotions']);

        //Simple user side
        Permission::create(['name'=>'create notes']);
        Permission::create(['name'=>'delete notes']);
        //Cards
        Permission::create(['name'=>'create cards']);
        Permission::create(['name'=>'edit owner']);
        //Pets
        Permission::create(['name'=>'add pet']);
        Permission::create(['name'=>'edit pet']);
        //Visits
        Permission::create(['name'=>'create visit']);
        Permission::create(['name'=>'edit visit']);

        //Creating role "dev" and assigning permissions to the "dev" role
        Role::create([
            'name' => 'dev',
            'translate' => 'Разработчик',
        ])->syncPermissions(Permission::all());


        //Creating role "admin" and assigning permissions to the "admin" role
        Role::create([
            'name' => 'admin',
            'translate' => 'Администратор',
        ])->syncPermissions(Permission::whereNotIn('id', [1])->get());

        //Creating role "doctor" and assigning permissions to the "doctor" role
        Role::create([
            'name' => 'doctor',
            'translate' => 'Врач',
        ])->syncPermissions([
            'create notes',
            'delete notes',
            'create cards',
            'edit owner',
            'add pet',
            'edit pet',
            'create visit',
            'edit visit',
        ]);

        //Assigning roles to users
            //Dev
        $dev = User::find(1);
        $dev->assignRole('dev');
            //Admin
        $admin = User::find(2);
        $admin->assignRole('admin');
            //Doctor
        $doctors = User::whereNotIn('id', [1,2])->get();
        foreach ($doctors as $doctor)
        {
            $doctor->assignRole('doctor');
        }
    }
}
