<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SalesItem;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_order_no',
        'customer_name', 
        'total_discount',
        'total_amount',  
        'sale_date',     
        'payment_method',
        'status',        
        'created_by',    
        'approved_by',   
        'remarks',       
    ];

    public function salesItem()
    {
        return $this->hasMany(SalesItem::class, 'sale_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($sales) {
            if(empty($sales->sales_order_no))
            {
                $sales->sales_order_no = self::generateSalesOrderNumber();
            }
        });
    }

    private static function generateSalesOrderNumber()
    {
        do {
            $salesOrderNo = 'SO' . rand(1000000, 99999999);
        } while ( self::where('sales_order_no', $salesOrderNo)->exists() );
        
        return  $salesOrderNo;
    }

}
