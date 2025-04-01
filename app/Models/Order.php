<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['customer_id', 'order_date', 'status', 'total_amount'];
    
    protected $casts = [
        'order_date' => 'datetime',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}