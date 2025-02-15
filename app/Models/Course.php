<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Course extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function material(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function assigment(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function enroll_students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_courses', 'course_id', 'student_id');
    }
}
