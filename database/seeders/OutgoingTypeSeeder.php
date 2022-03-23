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
        $name = [
            'Surat Undangan',
            'Surat Pengusulan Pensiun',
            'Surat Keterangan',
            'Surat Mutasi',
            'Surat Ijazah Belum Jadi',
            'Surat Ijazah Hilang/Rusak',
            'Surat Pindah Sekolah',
        ];
        $number = [
            '005',
            '045.2',
            '422',
            '009',
            '010',
            '011',
            '012',
        ];

        for ($i = 0; $i < count($name); $i++) {
            $user = OutgoingType::create([
                'name'             => $name[$i],
                'number'           => $number[$i],
            ]);
            $user->save();
        };
    }
}
