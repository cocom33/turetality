<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imt extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['user_id', 'name', 'umur', 'berat_badan', 'tinggi_badan', 'hasil'];

    public function scopeExcept(Builder $builder, array $test): void
    {
        $col = ['user_id', 'name', 'umur', 'berat_badan', 'tinggi_badan', 'hasil'];

        $res = array_diff($col, $test);

        $builder->select($res);
    }
}