<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function collectionDetail()
    {
        return $this->belongsTo(CollectionDetail::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
