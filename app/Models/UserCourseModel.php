<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCourseModel extends Model
{
    protected $table = 'usercourse';
    protected $primaryKey = "key";
    protected $useAutoIncrement = false;

    protected $allowedFields = ['id_user', 'id_course'];
}
