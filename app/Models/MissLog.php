<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissLog extends Model
{
    protected $table = 'misslogs';
    
    protected $fillable = [
        'mission_id',
        'title',
        'content',
        'image',
    ];

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
