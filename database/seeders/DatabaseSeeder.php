<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            AdminSeeder::class,
            IncomingTypeSeeder::class,
            IncomingSeeder::class,
            OutgoingTypeSeeder::class,
            OutgoingSeeder::class,
        ]);
    }
}
