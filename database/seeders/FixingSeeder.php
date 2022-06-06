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
        $id = [
            'FX-00001',
        ];

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

        $fk_type = [
            'FT-01'
        ];

        $fk_student = [
            58947401
        ];

        $status = [
            0,
        ];

        for ($i = 0; $i < count($detail); $i++) {
            $user = Fixing::create([
                'id'            => $id[$i],
                'detail'            => $detail[$i],
                'number'            => $number[$i],
                'to'                => $to[$i],
                'letter'            => $letter[$i],
                'fk_student'        => $fk_student[$i],
                'fk_type'           => $fk_type[$i],
                'status'            => $status[0],
            ]);
            $user->save();
        };
    }
}
