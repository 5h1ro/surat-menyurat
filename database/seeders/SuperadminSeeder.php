<?php

namespace Database\Seeders;

use App\Models\Superadmin;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Sudarwati, S.Sos',
        ];

        $fk_user = [
            'superadmin@superadmin.com',
        ];

        $nip = [
            '197210292007012009',
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Superadmin::create([
                'name'             => $name[$i],
                'fk_user'          => $fk_user[$i],
                'nip'              => $nip[$i],
            ]);
            $user->save();
        };
    }
}
