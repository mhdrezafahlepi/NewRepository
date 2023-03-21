<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawab_Model extends Model
{
    protected $table = "tb_jawab";
    protected $primaryKey = 'id_jawab';
    protected $fillable = [
        'id_siswa',
        'id_pelajaran',
        'tgl_jawab',
    ];
}
