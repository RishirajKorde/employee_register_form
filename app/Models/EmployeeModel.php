<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees'; // Your database table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'position', 'mob' , 'address', 'dob'];
}
