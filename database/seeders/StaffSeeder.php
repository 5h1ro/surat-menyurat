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
        ];

        $id_user = [
            '8',
            '9',
        ];

        $nip = [
            '193307005',
            '193307006',
        ];

        $rank = [
            'Penata Muda Tk.I',
            'Penata Muda Tk.I',
        ];
        $class = [
            'III/b',
            'III/b',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Staff::create([
                'name'              => $name[$i],
                'id_user'           => $id_user[$i],
                'nip'               => $nip[$i],
                'rank'              => $rank[$i],
                'class'              => $class[$i],
            ]);
            $user->save();
        };
    }
}
