<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => "0111111111",
            'status' => 'active',
            'type' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt(123456789),
        ]);


        for ($i = 0, $ii = 50; $i <= $ii; $i++) {
            User::create([
                'name' => $faker->name . $i,
                'email' => 'test' . $i . '@test.com',
                'phone' => '0111111111'.$i,
                'status' => $faker->randomElement(['noActive', 'active', 'block']),
                'type' => 'client',
                'email_verified_at' => now(),
                'password' => bcrypt(123456789),
            ]);
        }
    }
}
