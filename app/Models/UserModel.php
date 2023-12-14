<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'user_id',
        'user_username',
        'user_name',
        'user_email',
        'user_mobile',
        'user_password',
    ];

    public function generate_user_id()
    {
        $prefix = 'UID';
        $random = uniqid();
        $generated_id = $prefix . $random;

        while ($this->id_is_unique($generated_id)) {
            $random = uniqid();
            $generated_id = $prefix . $random;
        }

        return $generated_id;
    }

    public function id_is_unique($id)
    {
        return $this->where('user_id', $id)->first() !== null;
    }
}
