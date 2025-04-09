<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $primaryKey = 'img_id';
    protected $table = 'images';
    protected $fillable = ['img_path'];
    public $timestamps = false;
}
