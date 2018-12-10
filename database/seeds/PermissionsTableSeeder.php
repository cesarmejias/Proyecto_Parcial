<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Permission list
        Permission::create(['name' => 'transactions.index']);
        Permission::create(['name' => 'transactions.edit']);
        Permission::create(['name' => 'transactions.show']);
        Permission::create(['name' => 'transactions.update']);
        Permission::create(['name' => 'transactions.store']);
        Permission::create(['name' => 'transactions.create']);
        Permission::create(['name' => 'transactions.destroy']);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'transactions.index',
            'transactions.edit',
            'transactions.show',
            'transactions.create',
            'transactions.destroy'
        ]);
        //$admin->givePermissionTo('transactions.index');
        //$admin->givePermissionTo(Permission::all());
       
        //Guest
        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'transactions.index',
            'transactions.show'
        ]);

        //User Admin
        $user = User::find(1); //Cesar Mejias
        $user->assignRole('Admin');
    }
}