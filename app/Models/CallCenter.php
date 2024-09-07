<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCenter extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'phone'];

    public function details()
    {
        return $this->hasMany(CallCenterDetail::class);
    }
}