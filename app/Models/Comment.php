<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'product_id',
        'user_id',
        'parent_id',
        'comment'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
