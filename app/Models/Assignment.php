<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function submission(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

}
