<?php

namespace Database\Seeders;

use App\Models\StaffType;
use Illuminate\Database\Seeder;

class StaffTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Kepegawaian',
            'Bendahara 1',
            'Bendahara 2',
            'Kurikulum',
            'Kesiswaan',
        ];

        foreach ($name as $data) {
            $user = StaffType::create([
                'name'             => $data,
            ]);
            $user->save();
        }
    }
}
