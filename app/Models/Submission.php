<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
