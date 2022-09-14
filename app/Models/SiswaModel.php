<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'siswa_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nisn','nama','jurusan'];
}
