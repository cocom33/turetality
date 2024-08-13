<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCenterDetail extends Model
{
    use HasFactory;

    protected $fillable = ['call_center_id', 'name', 'type', 'number'];
}