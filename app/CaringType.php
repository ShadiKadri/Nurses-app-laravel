<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaringType extends Model
{
    use HasFactory, SoftDeletes;

    protected $softDelete = true;

    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'caring_type';
}
