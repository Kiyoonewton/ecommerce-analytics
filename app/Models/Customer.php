<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'email'];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
