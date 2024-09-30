<?php

namespace App\Models;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesItem extends Model
{
    use HasFactory;

    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
