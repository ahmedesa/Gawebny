<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    protected $table = 'language';
    protected $fillable = [
        'name', 'code',

    ];
}
