<?php

namespace Database\Seeders;

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
        User::factory()
            ->create([
                'email' => $this->command->ask("Введите ваш email(для тестирование нотификаций)") ?? 'admin@admin.com',
                'password' => Hash::make('admin')
            ]);

        $this->call([ResourceSeeder::class, BookingSeeder::class]);
    }
}
