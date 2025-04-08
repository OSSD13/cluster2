<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'tag_id';
    protected $table = 'tags';

    protected $fillable = ['tag_name'];

    public function problems()
    {
        return $this->hasMany(Problem::class, 'tag_id', 'tag_id');
    }

}
