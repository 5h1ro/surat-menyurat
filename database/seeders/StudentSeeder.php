<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Syadhach Amaliya',
        ];

        $id_user = [
            '6',
        ];

        $birthplace = [
            'Ponorogo',
        ];

        $birthday = [
            '2005-10-08',
        ];

        $ni = [
            '7421',
        ];

        $class = [
            'IX',
        ];

        $nisn = [
            '0058947401',
        ];
        $gender = [
            'Perempuan',
        ];
        $religion = [
            'Hindu',
        ];
        $parent = [
            'Takanome Akani',
        ];
        $parent_job = [
            'Fisikawan',
        ];
        $address = [
            'Jl.Sumbawa RT.007/RW.002 Ds.Slahung,Kec.Slahung',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Student::create([
                'name'             => $name[$i],
                'id_user'          => $id_user[$i],
                'birthplace'             => $birthplace[$i],
                'birthday'             => $birthday[$i],
                'ni'             => $ni[$i],
                'class'             => $class[$i],
                'gender'             => $gender[$i],
                'nisn'             => $nisn[$i],
                'religion'             => $religion[$i],
                'parent'             => $parent[$i],
                'parent_job'             => $parent_job[$i],
                'address'             => $address[$i],
            ]);
            $user->save();
        };
    }
}
