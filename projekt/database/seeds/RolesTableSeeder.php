<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    public function run()
    {     
        $role = new \App\Roles();
        $role->name = 'Admin';
        $role->save();

        $role = new \App\Roles();
        $role->name = 'Moderator';
        $role->save();

        $role = new \App\Roles();
        $role->name = 'Uzytkownik';
        $role->save();
    }
}
