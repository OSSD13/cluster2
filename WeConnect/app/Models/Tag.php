<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'tag_id';
    protected $table = 'tags';
    protected $fillable = ['tag_name'];
    public $timestamps = false;

    public function problems()
    {
        return $this->belongsToMany(Problem::class, 'problems_has_tags', 'tag_id', 'prob_id');
    }
}
