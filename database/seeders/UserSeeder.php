<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = [
            'teacher@teacher.com',
            'teacher2@teacher2.com',
            'headmaster@headmaster.com',
            'admin@admin.com',
            'admin2@admin2.com',
            'student@student.com',
            'superadmin@superadmin.com',
            'staff@staff.com',
            'staff2@staff2.com',
        ];

        $role = [
            '1',
            '1',
            '2',
            '3',
            '3',
            '4',
            '5',
            '6',
            '6',
        ];

        for ($i = 0; $i < count($email); $i++) {
            $user = User::create([
                'email'             => $email[$i],
                'password'          => Hash::make('password'),
                'id_role'           => $role[$i]
            ]);
            $user->save();
        };
    }
}
