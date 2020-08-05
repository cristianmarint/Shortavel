<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class links extends Model
{
    protected $table = "links";

    protected $fillable=[
        'origin',
        'view_count'
    ];
}
