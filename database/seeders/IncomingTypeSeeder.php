<?php

namespace Database\Seeders;

use App\Models\IncomingType;
use Illuminate\Database\Seeder;

class IncomingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = [
            'IT-01',
            'IT-02',
            'IT-03',
        ];
        $name = [
            'Surat Perjanjian Kerja Sama',
            'Surat Dinas',
            'Surat Undangan',
        ];

        foreach ($name as $key => $data) {
            $user = IncomingType::create([
                'id'              => $id[$key],
                'name'             => $data,
            ]);
            $user->save();
        }
    }
}
