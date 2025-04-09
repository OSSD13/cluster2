<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
<<<<<<< HEAD
    protected $primaryKey = 'tag_id'; // ระบุให้ Laravel รู้ว่า primary key ชื่อ tag_id
    public $timestamps = false; // ถ้าไม่มี created_at / updated_at

    protected $fillable = ['tag_name'];
=======
    protected $table = 'tags';
    protected $fillable = ['tag_name'];
    public $timestamps = false;
>>>>>>> b3f26f8f7862b08511f747ef900598b1121c48dd
}
