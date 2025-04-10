<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    //
    protected $primaryKey = 'prob_id';
    protected $table = 'problems';
    protected $fillable = ['community_name', 'detail', 'province', 'district', 'sub_district', 'post_code', 'latitude', 'longitude'];

    public function tags()
{
    return $this->belongsToMany(Tag::class, 'problems_has_tags', 'prob_id', 'tag_id');
}
}
