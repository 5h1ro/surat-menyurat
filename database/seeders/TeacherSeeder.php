<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Dra. WINDU UTAMI',
            'LILIK DWI ASTUTI, S.Pd',
            'SUMINI, S.Pd',
            'H. HARI WAHYUDI, S.Pd',
            'IMRON BASUKI, S.Pd',
            'TEDY SETIYO NUGROHO, S.Pd',
            'H. SISWOHADI, S.Pd',
            'Dra. Hj. TRI ATMAWANI',
            'PRIHARTI, S.Pd',
            'MUJIONO, M.Pd',
            'SULISTYANTINAWATI, S.Pd',
            'IMAM MA ARIF, S.Pd',
            'Hj. IDA AJU KUSUMA WARDHANI MAS OED, S.Pd',
            'SUKMA INDAH PRIASTUTI, S.Pd',
            'Dra. SITI FATIMAH',
            'SONY SETYANTORO, S.Pd',
            'TRI WAHYU HARTIWI, S.Pd',
            'SITI CHOTIMAH IRWATI, S.Ag',
            'ABDUL HARIS, M.Pd.I',
            'FEBRIANA PUSPITASARI, S.Pd',
            'SRI PUJI ASTUTIK, S.Pd',
            'SUJIATIN, S.Pd',
            'SUDARWATI, S.Sos',
            'SUTRISNO, S.Sos',
            'MAMIK PURNAWATI',


        ];

        $fk_user = [
            'teacher@teacher.com',
            'teacher2@teacher2.com',
            'teacher3@teacher3.com',
            'teacher4@teacher4.com',
            'teacher5@teacher5.com',
            'teacher6@teacher6.com',
            'teacher7@teacher7.com',
            'teacher8@teacher8.com',
            'teacher9@teacher9.com',
            'teacher10@teacher10.com',
            'teacher11@teacher11.com',
            'teacher12@teacher12.com',
            'teacher13@teacher13.com',
            'teacher14@teacher14.com',
            'teacher15@teacher15.com',
            'teacher16@teacher16.com',
            'teacher17@teacher17.com',
            'teacher18@teacher18.com',
            'teacher19@teacher19.com',
            'teacher20@teacher20.com',
            'teacher21@teacher21.com',
            'teacher22@teacher22.com',
            'teacher23@teacher23.com',
            'teacher24@teacher24.com',
            'teacher25@teacher25.com',
        ];

        $nip = [
            '196407141988032010',
            '196506271991032006',
            '196310131984122004',
            '196501301988031009',
            '196403261990011002',
            '196703011989011006',
            '196309231988021001',
            '196506051996022001',
            '196705011998022004',
            '196809081995101001',
            '196909211995122005',
            '196905111998031006',
            '197105291997032006',
            '197404141998022002',
            '196303252006042002',
            '197003162007011020',
            '197301312008012015',
            '197401032008012011',
            '197909292008011014',
            '198602072010012036',
            '196110252006042003',
            '196710092007012016',
            '197210292007012009',
            '197607052007011012',
            '196805252007012030',

        ];

        $rank = [
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina Tingkat I',
            'Pembina',
            'Penata Tingkat I',
            'Penata Tingkat I',
            'Penata Tingkat I',
            'Penata Tingkat I',
            'Penata',
            'Penata Muda Tingkat I',
            'Penata Muda Tingkat I',
            'Penata Muda',
            'Penata Muda',
            'Pengatur Tingkat I',

        ];
        $class = [
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/b',
            'IV/a',
            'III/d',
            'III/d',
            'III/d',
            'III/d',
            'III/c',
            'III/b',
            'III/b',
            'III/a',
            'III/a',
            'II/d',

        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Teacher::create([
                'name'             => $name[$i],
                'fk_user'          => $fk_user[$i],
                'nip'              => $nip[$i],
                'rank'              => $rank[$i],
                'class'              => $class[$i],
            ]);
            $user->save();
        };
    }
}
