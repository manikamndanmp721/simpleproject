<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table='orders';
    use HasFactory;

    protected $appends  = ['order_date_format'];

    public function getOrderDateFormatAttribute($value)
    {
        return date("Y-m-d", strtotime($this->order_date) );
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
