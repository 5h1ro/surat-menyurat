<?php

namespace Database\Seeders;

use App\Models\OutgoingType;
use Illuminate\Database\Seeder;

class OutgoingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = [
            'OT-01',
            'OT-02',
            'OT-03',
            'OT-04',
            'OT-05',
        ];

        $name = [
            'Surat Undangan',
            'Surat Pengantar Pensiun',
            'Surat Keterangan',
            'Surat Mutasi',
            'Surat Ijazah Belum Jadi',
        ];
        $number = [
            '005',
            '045.2',
            '422',
            '422',
            '010',
        ];

        for ($i = 0; $i < count($name); $i++) {
            $user = OutgoingType::create([
                'id'             => $id[$i],
                'name'             => $name[$i],
                'number'           => $number[$i],
            ]);
            $user->save();
        };
    }
}
