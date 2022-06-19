<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Sudarwati, S.Pd, M.Pd',
            'SULISTYANTINAWATI, S.Pd',
            'TRI WAHYU HARTIWI, S.Pd',
            'IMRON BASUKI, S.Pd',
            'IMAM MA ARIF, S.Pd',

        ];

        $fk_user = [
            'staff@staff.com',
            'staff2@staff2.com',
            'staff3@staff3.com',
            'staff4@staff4.com',
            'staff5@staff5.com',
        ];

        $nip = [
            '197210292007012009',
            '196909211995122005',
            '197301312008012015',
            '196403261990011002',
            '196905111998031006',


        ];

        $rank = [
            'Penata Muda',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
        ];

        $class = [
            'III/a',
            'IV/b',
            'III/d',
            'IV/b',
            'IV/b',
        ];

        $fk_type = [
            'ST-01',
            'ST-02',
            'ST-03',
            'ST-04',
            'ST-05',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Staff::create([
                'name'              => $name[$i],
                'fk_user'           => $fk_user[$i],
                'nip'               => $nip[$i],
                'rank'              => $rank[$i],
                'class'             => $class[$i],
                'fk_type'           => $fk_type[$i],
            ]);
            $user->save();
        };
    }
}
