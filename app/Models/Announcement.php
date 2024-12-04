<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'email',
        'title',
        'program',
        'content',
        'media_path',
        'media_type',
        'video_length',
        'target_date',
        'display_duration',
        'digital_signature'
    ];

    protected $casts = [
        'target_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

   

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
