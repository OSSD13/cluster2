<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemHasTag extends Model
{
    //
    protected $table = 'problems_has_tags'; // ชื่อตารางใน DB

    public $timestamps = false; // ถ้า table ไม่มี created_at, updated_at

    protected $fillable = [
        'prob_id',
        'tag_id',
    ];
}
