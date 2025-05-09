<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getScreenshotAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }

        return null;
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }
}
