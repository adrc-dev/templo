<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'image_path',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
