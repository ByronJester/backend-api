<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $appends = [
        'owner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerAttribute()
    {
        return $this->user->name;
    }
}
