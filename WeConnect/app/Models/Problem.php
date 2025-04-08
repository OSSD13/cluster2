<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $primaryKey = 'prob_id';

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

    // ✅ เพิ่มความสัมพันธ์
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'tag_id');
    }
}
