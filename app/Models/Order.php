<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = ["order_date"]; 
    protected $table = 'prorder';
    protected $fillable = ['user_id','order_code','discount','items','shipping_cost','total_price','order','address','order_status_id','payment_code','status','created_by'];

    function  orderStatus(){
        return $this->belongsTo(OrderStatus::class);
    }
    function  payment(){
        return $this->belongsTo(Payment::class);
    }

    function  createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    function  userId(){
        return $this->belongsTo(User::class,'user_id');
    }

    function  updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
}
