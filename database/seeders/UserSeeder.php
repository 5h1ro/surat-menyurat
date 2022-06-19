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
            'teacher3@teacher3.com',
            'teacher4@teacher4.com',
            'teacher5@teacher5.com',
            'teacher6@teacher6.com',
            'teacher7@teacher7.com',
            'teacher8@teacher8.com',
            'teacher9@teacher9.com',
            'teacher10@teacher10.com',
            'teacher11@teacher11.com',
            'teacher12@teacher12.com',
            'teacher13@teacher13.com',
            'teacher14@teacher14.com',
            'teacher15@teacher15.com',
            'teacher16@teacher16.com',
            'teacher17@teacher17.com',
            'teacher18@teacher18.com',
            'teacher19@teacher19.com',
            'teacher20@teacher20.com',
            'teacher21@teacher21.com',
            'teacher22@teacher22.com',
            'teacher23@teacher23.com',
            'teacher24@teacher24.com',
            'teacher25@teacher25.com',
            'headmaster@headmaster.com',
            'admin@admin.com',
            'admin2@admin2.com',
            'student@student.com',
            'superadmin@superadmin.com',
            'staff@staff.com',
            'staff2@staff2.com',
            'staff3@staff3.com',
            'staff4@staff4.com',
            'staff5@staff5.com',
        ];

        $role = [
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-01',
            'R-02',
            'R-03',
            'R-03',
            'R-04',
            'R-05',
            'R-06',
            'R-06',
            'R-06',
            'R-06',
            'R-06',
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
