<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'ahmed',
            'email' => 'ahmed@ahmed.com',
            'role_id' => 'ADMIN',
            'password' => Hash::make('ahmed')
        ]);
        // $this->call([

        //     UsersSeeder::class,

        // ]);
        // \App\Models\User::factory(10)->create();
    }
}
