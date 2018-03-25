<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = 'admin';
        $role->save();

        $role_c = new Role;
        $role_c->name = 'customer';
        $role_c->save();
        
        $role_w = new Role;
        $role_w->name = 'worker';
        $role_w->save();
        
        $role_co = new Role;
        $role_co->name = 'company';
        $role_co->save();
    }
}
