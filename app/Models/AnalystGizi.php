<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalystGizi extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['type', 'user_id', 'menu', 'asal', 'photo', 'date', 'catatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}