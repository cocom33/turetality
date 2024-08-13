<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalystChse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'number', 'type', 'check', 'place', 'catatan', 'photo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}