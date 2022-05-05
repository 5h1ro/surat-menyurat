<?php

namespace Database\Seeders;

use App\Models\FixingType;
use Illuminate\Database\Seeder;

class FixingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $name = [
            'Surat Kerusakah Ijazah',
            'Surat Ijazah Hilang',
        ];
        $number = [
            '422',
            '420',
        ];

        for ($i = 0; $i < count($name); $i++) {
            $user = FixingType::create([
                'name'             => $name[$i],
                'number'           => $number[$i],
            ]);
            $user->save();
        };
    }
}
