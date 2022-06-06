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
        $id = [
            'ST-01',
            'ST-02',
            'ST-03',
            'ST-04',
            'ST-05',
        ];

        $name = [
            'Kepegawaian',
            'Bendahara 1',
            'Bendahara 2',
            'Kurikulum',
            'Kesiswaan',
        ];

        foreach ($name as $key => $data) {
            $user = StaffType::create([
                'id'               => $id[$key],
                'name'             => $data,
            ]);
            $user->save();
        }
    }
}
