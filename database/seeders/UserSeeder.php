<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Table cleaning
        User::query()->delete();

        // Admin create
        $password = 'password';

        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt($password),
        ]);

        $adminRole = Role::query()->where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // Operator create
        $operator = User::query()->create([
            'name' => 'Operator',
            'email' => 'operator@operator.com',
            'password' => bcrypt($password),
        ]);

        $operatorRole = Role::query()->where('name', 'operator')->first();
        $operator->roles()->attach($operatorRole);

        // User create
        $user = User::query()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt($password),
        ]);

        $userRole = Role::query()->where('name', 'user')->first();
        $user->roles()->attach($userRole);

        $this->command->info(class_basename(__CLASS__) . ' completed');
    }
}
