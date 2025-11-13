<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    protected $fillable = [
        'vendor_id',
        'category_id',
        'img_path',
        'name',
        'price',
        'description',
        'description_tm',
        'description_ru',
    ];

    public function getName()
    {
        $locale = app()->getLocale();

        if ($locale == 'tm') {
            return $this->description_tm ?: $this->description;
        } else if ($locale == 'ru') {
            return $this->description_ru ?: $this->description;
        }
        return $this->description;
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function LikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
