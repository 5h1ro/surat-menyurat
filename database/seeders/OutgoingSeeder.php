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

        $id_type = [
            1,
            1,
        ];

        $id_teacher = [
            1,
            2,
        ];

        $status = [
            0,
        ];

        for ($i = 0; $i < count($detail); $i++) {
            $user = Outgoing::create([
                'detail'            => $detail[$i],
                'number'            => $number[$i],
                'to'                => $to[$i],
                'letter'            => $letter[$i],
                'id_type'           => $id_type[$i],
                'id_teacher'        => $id_teacher[$i],
                'status'            => $status[0],
            ]);
            $user->save();
        };
    }
}
