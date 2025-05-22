<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'showOpen',
        'showCountdown',
        'showMadeBy',
        'background',
        'titleColor',
        'textColor',
        'buttonColor',
        'buttonText',
        'buttonclColor',
        'buttonclText',
        'deleteColor',
    ];
}
