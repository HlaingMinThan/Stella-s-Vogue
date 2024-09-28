<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    // Accessor for the 'sum' property
    public function getSumAttribute()
    {
        return $this->fabric + $this->under + $this->sample_pattern + $this->sew_fees
            + $this->model_fees + $this->model_deli_fees + $this->boosting
            + $this->phone_bill + $this->packing_fees + $this->extra_charges
            + $this->taxi_charges + $this->ga__vlog_charges;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'collection_id');
    }
}
