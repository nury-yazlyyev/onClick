<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->hasMany(Follow::class, 'follower_id', 'id');
    }

    public function followings(){
        return $this->hasMany(Follow::class, 'following_id', 'id');
    }

}
