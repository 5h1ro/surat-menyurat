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

        $id_user = [
            '8',
            '9',
            '10',
            '11',
            '12',
        ];

        $nip = [
            '193307005',
            '193307006',
            '193307007',
            '193307008',
            '193307009',
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

        $id_type = [
            '1',
            '2',
            '3',
            '4',
            '5',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Staff::create([
                'name'              => $name[$i],
                'id_user'           => $id_user[$i],
                'nip'               => $nip[$i],
                'rank'              => $rank[$i],
                'class'             => $class[$i],
                'id_type'           => $id_type[$i],
            ]);
            $user->save();
        };
    }
}
