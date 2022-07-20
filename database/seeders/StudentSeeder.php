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
            'Tiara'
        ];

        $fk_user = [
            'student@student.com',
            'yudrax89@gmail.com'
        ];

        $birthplace = [
            'Ponorogo',
            'malang'
        ];

        $birthday = [
            '2005-10-08',
            '2003-8-07',
        ];

        $ni = [
            '7421',
            '7689'
        ];

        $class = [
            'IX',
            'VII'
        ];

        $nisn = [
            '0058947401',
            '0890987645'
        ];
        $gender = [
            'Perempuan',
            'Perempuan',
        ];
        $religion = [
            'Hindu',
            'Islam'
        ];
        $parent = [
            'Takanome Akani',
            'Paijo'
        ];
        $parent_job = [
            'Fisikawan',
            'Pengusaha'
        ];
        $address = [
            'Jl.Sumbawa RT.007/RW.002 Ds.Slahung,Kec.Slahung',
            'Balong'
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Student::create([
                'name'             => $name[$i],
                'fk_user'          => $fk_user[$i],
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
