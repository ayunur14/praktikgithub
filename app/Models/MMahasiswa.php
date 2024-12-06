<?php

namespace App\Models;

use CodeIgniter\Model;

class MMahasiswa extends Model
{
    protected $table = 'tbl_mahasiswa';
    protected $primaryKey = 'id_mhs';
    protected $allowedFields = ['nim', 'nama', 'alamat', 'tgl_lahir', 'jk', 'email', 'foto', 'create_date'];
    protected $useTimestamps = false;
    protected $createdField = 'create_date';
    // protected $updatedField = 'update_date';
}
