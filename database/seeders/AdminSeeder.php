<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
            'Mamik Purnawati',
        ];

        $fk_user = [
            'admin@admin.com',
            'admin2@admin2.com',
        ];

        $nip = [
            '197210292007012009',
            '196805252007012030',

        ];

        $status = [
            1,
            0,
        ];


        for ($i = 0; $i < count($name); $i++) {
            $user = Admin::create([
                'name'              => $name[$i],
                'fk_user'           => $fk_user[$i],
                'nip'               => $nip[$i],
                'status'            => $status[$i],
            ]);
            $user->save();
        };
    }
}
