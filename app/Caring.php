<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caring extends Model
{
    use HasFactory, SoftDeletes;

    protected $softDelete = true;

    protected $fillable = [
        'nurse_id', 'caring_type_id', 'patient_id', 'time', 'description'
    ];


    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function nurse(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function caringType(): BelongsTo
    {
        return $this->belongsTo(CaringType::class)->withTrashed();
    }
}
