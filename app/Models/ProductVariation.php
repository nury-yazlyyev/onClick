<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    protected $fillable = [
        'vendor_id',
        'category_id',
        'size_id',
        'stock',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->price ?? $this->product->price;
    }
}
