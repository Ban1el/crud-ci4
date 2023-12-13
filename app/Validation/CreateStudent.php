<?php

namespace App\Validation;

class CreateStudent
{
    public function is_not_tampered($value, string &$error = null)
    {
        $session = session();
        $generated_id = $session->get('generated_student_id');

        if ($generated_id == null) {
            $error = 'Generated student ID not found in the session';
            return false;
        } else if ($generated_id != $value) {
            $error = 'ID is tampered';
            return false;
        } else {
            return true;
        }
    }
}
