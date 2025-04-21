<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnList extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date',
    ];
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
