<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $adminRole = \App\Models\Role::factory()->create([
            'name' => 'администратор сервиса',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'владелец организации',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'администратор организации',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'пользователь организации',
        ]);

        $company1 = \App\Models\Company::factory()->create([
            'name' => 'А-Кор',
        ]);

        $user = \App\Models\User::factory()->create([
            'password' => Hash::make('admin'),
            'email' => 'admin@admin.com',
            'firstname' => 'Иван',
            'lastname' => 'Иванов',
        ]);

        $user->roles()->sync($adminRole);
        $user->company()->sync($company1);
    }
}
