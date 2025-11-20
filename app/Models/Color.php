<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'name',
        'hex_code',
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
