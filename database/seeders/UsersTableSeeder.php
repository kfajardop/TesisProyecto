<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       // Usuario Developer
        $dev = User::create([
            "username" => "dev",
            "name"     => "Developer",
            "password" => bcrypt("admin"),
        ]);
        $dev->syncRoles(Role::DEVELOPER);
        $dev->options()->sync(Option::pluck('id')->toArray());
        $dev->shortcuts()->sync([3,4,5,6]);

        // Usuario Super Admin
        $super = User::create([
            "username" => "Super",
            "name"     => "Super Admin",
            "password" => bcrypt("123"),
        ]);
        $super->syncRoles(Role::SUPERADMIN);
        $super->options()->sync(Option::pluck('id')->toArray());
        $super->shortcuts()->sync([3,4,5,6]);

        // Usuario Administrador
        $admin = User::create([
            "username" => "Admin",
            "name"     => "Administrador",
            "password" => bcrypt("123"),
        ]);
        $admin->syncRoles(Role::ADMIN);
        $admin->options()->sync(Option::pluck('id')->toArray());
        $admin->shortcuts()->sync([3,4,5,6]);

        // Usuario Tester
        $tester = User::create([
            "username" => "Tester",
            "name"     => "Tester",
            "password" => bcrypt("123"),
        ]);
        $tester->syncRoles(Role::TESTER);
        $tester->options()->sync(Option::pluck('id')->toArray());
        $tester->shortcuts()->sync([3,4,5,6]);
    }

}
