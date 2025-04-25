<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Timecapsule extends Model implements HasMedia
{
    protected $fillable = ['user_id', 'name', 'text', 'time', 'madeBy'];
}