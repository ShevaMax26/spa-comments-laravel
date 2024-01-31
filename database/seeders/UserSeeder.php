<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Олександр Усик',
                'email' => 'usik@gmail.com',
            ],
            [
                'name' => 'Володимир Кличко',
                'email' => 'klichko@gmail.com',
            ],
            [
                'name' => 'Віталій Кличко',
                'email' => 'v.klichko@gmail.com',
            ],
            [
                'name' => 'Василь Ломаченко',
                'email' => 'lomachenko@gmail.com',
            ],
            [
                'name' => 'Андрій Шевченко',
                'email' => 'shevchenko@gmail.com',
            ],
            [
                'name' => 'Володимир Боклан',
                'email' => 'volodymyr.boklan@gmail.com',
            ],
            [
                'name' => 'Тарас Цимбалюк',
                'email' => 'cymbalyuk@gmail.com',
            ],
            [
                'name' => 'Євген Коноплянка',
                'email' => 'konoplyanka@gmail.com',
            ],
        ];

        foreach ($users as $person) {
            User::factory([
                'name' => $person['name'],
                'email' => $person['email'],
            ])
                ->create();
        }

        User::factory()->count(20)->create();
    }
}

