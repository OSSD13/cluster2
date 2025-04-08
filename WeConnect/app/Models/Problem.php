<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    //
    protected $primaryKey = 'prob_id'; // 👈 เพิ่มบรรทัดนี้

    protected $table = 'problems';
    protected $fillable = [
        'community_name',
        'detail',
        'province',
        'district',
        'sub_district',
        'post_code',
        'tag_id',
        'latitude',
        'longitude'
    ];
}
