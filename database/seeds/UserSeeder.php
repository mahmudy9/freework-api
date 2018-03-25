<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name' , 'admin')->first();
        $role_c = Role::where('name' , 'customer')->first();
        $role_w = Role::where('name' , 'worker')->first();
        $role_co = Role::where('name' , 'company')->first();

        $admin = new User;
        $admin->name = 'Mahmud Ibrahim';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->city = 'Cairo';
        $admin->phone = '01234567890';
        $admin->address = '1234 Main St';
        $admin->save();
        $admin->roles()->attach($role_admin);
        

        $customer = new User;
        $customer->name = 'Customer';
        $customer->email = 'customer@admin.com';
        $customer->password = bcrypt('123456');
        $customer->city = 'Cairo';
        $customer->phone = '01234567890';
        $customer->address = '1234 Main St';
        $customer->save();
        $customer->roles()->attach($role_c);


        $worker = new User;
        $worker->name = 'Free Worker';
        $worker->email = 'worker@admin.com';
        $worker->password = bcrypt('123456');
        $worker->city = 'Cairo';
        $worker->phone = '01234567890';
        $worker->address = '1234 Main St';
        $worker->save();
        $worker->roles()->attach($role_w);


        $company = new User;
        $company->name = 'Constructions.inc';
        $company->email = 'company@admin.com';
        $company->password = bcrypt('123456');
        $company->city = 'Cairo';
        $company->phone = '01234567890';
        $company->address = '1234 Main St';
        $company->save();
        $company->roles()->attach($role_co);

        
    }
}
