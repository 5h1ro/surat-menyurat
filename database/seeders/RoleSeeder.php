<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Teacher',
            'Headmaster',
            'Admin',
            'Student',
            'Superadmin',
            'Staff'
        ];

        $incoming = [
            1,
            1,
            1,
            0,
            0,
            1
        ];

        $outgoing = [
            1,
            1,
            1,
            1,
            0,
            1
        ];

        $disposition = [
            0,
            1,
            1,
            0,
            0,
            0
        ];
        for ($i = 0; $i < count($name); $i++) {
            $user = Role::create([
                'name'          => $name[$i],
                'incoming'      => $incoming[$i],
                'outgoing'      => $outgoing[$i],
                'disposition'      => $disposition[$i]
            ]);
            $user->save();
        };
    }
}
