<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = new Role();
        $role->name = 'Admin';
        $role->slug = 'admin';
        $role->save();

        $user = new User();
        $user->name = 'Super Admin';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('password');
        $user->password_status = '1';
        $user->save();

        $adminRole = Role::where('slug', 'admin')->first();

        if ($adminRole) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
