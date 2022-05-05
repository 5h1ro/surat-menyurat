<?php

namespace Database\Seeders;

use App\Models\Fixing;
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
            SuperadminSeeder::class,
            HeadmasterSeeder::class,
            StaffSeeder::class,
            AdminSeeder::class,
            StudentSeeder::class,
            IncomingTypeSeeder::class,
            IncomingSeeder::class,
            OutgoingTypeSeeder::class,
            OutgoingSeeder::class,
            DispositionSeeder::class,
            FixingTypeSeeder::class,
            FixingSeeder::class,
            SetupSeeder::class
        ]);
    }
}
