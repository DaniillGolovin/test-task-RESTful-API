<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Table cleaning
        Role::query()->delete();

        Role::create(['name' => 'admin', 'description' => 'Admin']);
        Role::create(['name' => 'operator', 'description' => 'Operator']);
        Role::create(['name' => 'user', 'description' => 'User']);

        $this->command->info(class_basename(__CLASS__) . ' completed');
    }
}
