<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->delete();

        $user = User::create([
            'name' => 'Fábio Lopes',
            'email' => 'fzlopes1@gmail.com',
            'password' => bcrypt('123456'),
            'first_access' => true,
            'is_active' => true
        ]);

        $user->roles()->attach(Role::all()->where('role', 'SUPER_ADMIN')->first()->value('id'));

        $this->command->info('The superadmin Fábio was created.');

        $user = User::create([
            'name' => 'Regina',
            'email' => 'regina@gmail.com',
            'password' => bcrypt('123456'),
            'first_access' => true,
            'is_active' => true
        ]);

        $user->roles()->attach(Role::all()->where('role', 'SUPER_ADMIN')->first()->value('id'));

        $this->command->info('The superadmin Regina was created.');
    }
}
