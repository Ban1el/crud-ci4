<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'student_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'student_id',
        'student_name',
        'student_mobile',
        'student_email',
        'student_course',
        'student_section',
        'student_year_level',
        'student_profile_picture',
    ];

    public function generate_student_id()
    {
        $prefix = 'SI';
        $uniqueId = uniqid();
        $generatedId = $prefix . '_' . $uniqueId;

        while ($this->check_duplicate_id($generatedId)) {
            $uniqueId = uniqid();
            $generatedId = $prefix . '_' . $uniqueId;
        }

        return $generatedId;
    }

    private function check_duplicate_id($id)
    {
        return $this->where('student_id', $id)->first() !== null;
    }
}
