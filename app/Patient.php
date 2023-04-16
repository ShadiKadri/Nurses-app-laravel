<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patients';

    protected $softDelete = true;


    protected $fillable = [
        'name', 'user_id', 'room_photo', 'is_stopped'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
