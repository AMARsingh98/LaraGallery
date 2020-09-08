<?php

namespace App;
use App\Image;
use App\Album;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected  $fillable=['name','album_id'];   
}
