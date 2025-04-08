<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $primaryKey = 'tag_id'; // ระบุให้ Laravel รู้ว่า primary key ชื่อ tag_id
    public $timestamps = false; // ถ้าไม่มี created_at / updated_at

    protected $fillable = ['tag_name'];
}
