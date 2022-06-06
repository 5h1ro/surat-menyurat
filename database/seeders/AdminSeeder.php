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
            'Hari Subagyo',
            'Mai Nur Arbain',
        ];

        $fk_user = [
            'admin@admin.com',
            'admin2@admin2.com',
        ];

        $nip = [
            '193307001234565451',
            '193307005678765462',
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
