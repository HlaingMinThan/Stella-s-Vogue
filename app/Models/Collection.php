<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $appends = ['sum', 'order_total'];

    // Accessor for the 'sum' budget property
    public function getSumAttribute()
    {
        return $this->fabric + $this->under + $this->sample_pattern + $this->sew_fees
            + $this->model_fees + $this->model_deli_fees + $this->boosting
            + $this->phone_bill + $this->packing_fees + $this->extra_charges
            + $this->taxi_charges + $this->ga__vlog_charges;
    }

    public function getOrderTotalAttribute()
    {
        return $this->orderDetails->sum('amount');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'collection_id');
    }
}
