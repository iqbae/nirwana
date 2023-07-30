<?php

namespace Database\Seeders;

use App\Models\Operational\Doctor;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = [
            [
            'specialist_id' => '2',
            'name'          => 'dr. Iskandar Thalib',
            'fee'           => '250000',
            'photo'         => NULL,
            'senin'         => '12.00-15.00',
            'selasa'        => '16.00-21.00',
            'rabu'          => '16.00-21.00',
            'kamis'         => '16.00-21.00',
            'jumat'         => '16.00-21.00',
            'sabtu'         => '-',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        Doctor::insert($doctor);
    }
}
