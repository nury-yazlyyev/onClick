<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'total_price',
        'shipping_price',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
 
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
