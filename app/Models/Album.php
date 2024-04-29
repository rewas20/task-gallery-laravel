<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    //get the owner of the user's album
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
