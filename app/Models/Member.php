<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    protected $fillable = ['user_id', 'payment_proof_path', 'status'];
    protected $table = 'memberships';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
