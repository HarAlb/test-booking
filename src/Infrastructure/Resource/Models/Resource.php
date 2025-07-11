<?php

namespace Infrastructure\Resource\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description'
    ];
}
