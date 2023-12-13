<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class StudentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $student = $this->generateFakeStudent();
            $this->db->table('students')->insert($student);
        }
    }

    private function generateFakeStudent()
    {
        $fakerObject = Factory::create();

        $position = [
            'BSIT',
            'BSCS',
            'BSCE'
        ];

        return array(
            'student_name' => $fakerObject->name,
            'student_email' => $fakerObject->email,
            'student_mobile' => $fakerObject->phoneNumber,
            'student_designation' => $fakerObject->randomElement($position),
        );
    }
}
