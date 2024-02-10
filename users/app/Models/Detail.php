<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'key',
        'value',
        'icon',
        'user_id',
        'status',
        'type',
       
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
