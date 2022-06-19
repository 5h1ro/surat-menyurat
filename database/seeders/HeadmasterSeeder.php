<?php

namespace Database\Seeders;

use App\Models\Headmaster;
use Illuminate\Database\Seeder;

class HeadmasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'SUMIRAN, S.Pd, M.Pd',
        ];

        $fk_user = [
            'headmaster@headmaster.com',
        ];

        $nip = [
            '196610151990011021',
        ];

        $rank = [
            'Pembina Utama muda',
        ];
        $class = [
            'IV/c',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Headmaster::create([
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
