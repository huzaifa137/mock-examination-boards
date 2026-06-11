<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class TestSchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::create([
            'school_type' => 'mixed',
            'name' => 'Mbogo mixed',
            'email' => 'techmhalid@gmail.com',
            'phone' => '0701098373',
            'address' => 'kawanda',
            'registration_code' => 'SCH-'.date('Y').'-TEST-'.time(),
            'registration_date' => now(),
            'added_by' => 1,
        ]);
    }
}
