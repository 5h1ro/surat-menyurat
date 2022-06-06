<?php

namespace Database\Seeders;

use App\Models\Disposition;
use Illuminate\Database\Seeder;

class DispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Disposition::create([
            'id'                    => 'DP-00001',
            'fk_incoming'           => '005/034/405.07.3.23/2022',
            'letter'                => asset('assets/test.pdf'),
        ]);
        $user->save();
    }
}
