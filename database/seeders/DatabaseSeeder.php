<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CardsType;
use App\Models\CreditsType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::query()->insert(
             [
                'number' => 'admin',
                'password' => Hash::make('admin'),
                 'isAdmin' => true
             ]
         );

         CardsType::query()->insert(
             [
                 [
                    'name' => 'Дебетовая'
                 ],
                 [
                     'name' => 'Кредитная'
                 ]
             ]
         );

         CreditsType::query()->insert(
             [
                [
                    'name' => 'Физ. лицо'
                ],
                [
                    'name' => 'Юр. лицо'
                ]
             ]
         );
    }
}
