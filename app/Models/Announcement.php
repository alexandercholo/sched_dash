<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'program',
        'media_path',
        'media_type',
        'target_date',
        'digital_signature'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'target_date'
    ];

    protected $casts = [
        'target_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'announcement_user')
            ->withTimestamps();
    }
}
