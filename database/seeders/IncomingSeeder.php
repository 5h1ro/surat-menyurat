<?php

namespace Database\Seeders;

use App\Models\Incoming;
use Illuminate\Database\Seeder;

class IncomingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = [
            'Pembinaan Sekolah Adiwiyata',
        ];

        $letter = [
            asset('assets/test.pdf'),
        ];

        $fk_type = [
            'IT-02'
        ];

        $fk_admin = [
            197210292007012009,
        ];

        $fk_headmaster = [
            196610151990011021,
        ];

        $number = [
            '005/034/405.07.3.23/2022'
        ];
        $letter_number = [
            '005/96/405.23/2022'
        ];
        $letter_date = [
            '2022-02-02'
        ];
        $from = [
            'Pemerintah kab. Ponorogo Dinas Lingkungan Hidup'
        ];
        $detail = [
            'Undangan pembinaan calon sekolah adiwiyata kabupate, calon sekolah adiwiyata provinsi, dan calon sekolah adiwiyata nasional tahun 2022'
        ];

        for ($i = 0; $i < 2000; $i++) {
            if (strlen($i) < 2) {
                $number = '00' . $i;
            } elseif (strlen($i) == 2) {
                $number = '0' . $i;
            } elseif (strlen($i) > 2) {
                $number = $i;
            }
            $user = Incoming::create([
                'title'             => $title[0],
                'number'             => '005/' . $number . '/405.07.3.23/2022',
                'letter_number'             => $letter_number[0],
                'letter_date'             => $letter_date[0],
                'from'             => $from[0],
                'detail'             => $detail[0],
                'letter'            => $letter[0],
                'fk_type'           => $fk_type[0],
                'fk_admin'          => $fk_admin[0],
                'fk_headmaster'        => $fk_headmaster[0]
            ]);
            $user->save();
        };
    }
}
