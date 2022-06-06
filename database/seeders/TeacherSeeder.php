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
            'Muhammad Inam Eka Pramuka, S.Pd',
            'Eka Novita Sari, S.Pd',
        ];

        $fk_user = [
            'teacher@teacher.com',
            'teacher2@teacher2.com',
        ];

        $nip = [
            '19601129198703105',
            '19601129198703106',
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
