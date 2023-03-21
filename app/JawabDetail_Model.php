<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabDetail_Model extends Model
{
    protected $table = "tb_jawab_detail";
    protected $primaryKey = 'id_jawab_detail';
    protected $fillable = [
        'id_jawab',
        'id_quis',
        'jawaban',
        'value',
    ];
}