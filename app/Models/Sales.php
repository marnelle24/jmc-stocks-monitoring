<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SalesItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'product_id',
        'quantity',
        'price',
        'total',
        'sale_date',
        'payment_method',
        'status',
        'remarks'
    ];

    public function salesItem()
    {
        return $this->hasMany(SalesItem::class, 'sale_id');
    }

}
