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
            'Agus Ginanjar',
            'Budi Setiawan',
            'Imron Basuki',
            'Imam ',
            'Siti',


        ];

        $fk_user = [
            'staff@staff.com',
            'staff2@staff2.com',
            'staff3@staff3.com',
            'staff4@staff4.com',
            'staff5@staff5.com',
        ];

        $nip = [
            '193307131234320051',
            '193307345676543006',
            '193307456787653007',
            '193307678987645008',
            '193307567876545009',
        ];

        $rank = [
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
        ];

        $class = [
            'III/b',
            'III/b',
            'III/b',
            'III/b',
            'III/b',
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
