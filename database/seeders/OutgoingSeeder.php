<?php

namespace Database\Seeders;

use App\Models\Outgoing;
use Illuminate\Database\Seeder;

class OutgoingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = [
            'OT-00001',
            'OT-00002',
        ];
        $detail = [
            'Surat Undangan Komite',
            'Surat Undangan Pengambilan Rapot',
        ];

        $number = [
            '005/001/405.07.3.23/2022',
            '005/002/405.07.3.23/2022',
        ];

        $to = [
            'Pengurus Komite',
            'Wali Muri',
        ];

        $letter = [
            asset('assets/test.pdf'),
            asset('assets/test.pdf'),
        ];

        $fk_type = [
            'OT-01',
            'OT-01',
        ];

        $fk_teacher = [
            19601129198703105,
            19601129198703106,
        ];

        $status = [
            0,
        ];

        for ($i = 0; $i < count($detail); $i++) {
            $user = Outgoing::create([
                'id'            => $id[$i],
                'detail'            => $detail[$i],
                'number'            => $number[$i],
                'to'                => $to[$i],
                'letter'            => $letter[$i],
                'fk_type'           => $fk_type[$i],
                'fk_teacher'        => $fk_teacher[$i],
                'status'            => $status[0],
            ]);
            $user->save();
        };
    }
}
