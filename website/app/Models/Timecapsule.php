<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timecapsule extends Model
{
    protected $fillable = ['user_id', 'name', 'text', 'time'];
}