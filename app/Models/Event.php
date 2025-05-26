<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'event_date',
        'event_end_date',
        'event_time',
        'event_end_time',
        'event_location',
        'modality',
        'price',
        'currency',
        'featured_image',
        'is_active',
        'language',
        'seo_title',
        'seo_description'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_end_date' => 'date',
        'event_time' => 'datetime:H:i',
        'event_end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    public function registeredUsers()
    {
        return $this->belongsToMany(User::class, 'event_registrations')->withTimestamps();
    }
}
