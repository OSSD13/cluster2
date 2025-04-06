<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    //
    protected $table = 'problems';
    protected $fillable = ['community_name', 'detail', 'province', 'district', 'sub_district', 'post_code', 'latitude', 'longitude'];
}
