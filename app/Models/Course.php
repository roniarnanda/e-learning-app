<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Course extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
