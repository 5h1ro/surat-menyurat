<?php

namespace Database\Seeders;

use App\Models\Fixing;
use Illuminate\Database\Seeder;

class FixingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $detail = [
            'Surat Keterangan Rekomendasi',
        ];

        $number = [
            '422/003/405.07.3.23/2022',
        ];

        $to = [
            'Syadhach Amaliya',
        ];

        $letter = [
            asset('assets/surat_keterangan.pdf'),
        ];

        $id_type = [
            1
        ];

        $id_student = [
            1
        ];

        $status = [
            0,
        ];

        for ($i = 0; $i < count($detail); $i++) {
            $user = Fixing::create([
                'detail'            => $detail[$i],
                'number'            => $number[$i],
                'to'                => $to[$i],
                'letter'            => $letter[$i],
                'id_student'        => $id_student[$i],
                'id_type'           => $id_type[$i],
                'status'            => $status[0],
            ]);
            $user->save();
        };
    }
}
