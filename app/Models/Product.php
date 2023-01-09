<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['category_id','subcategory_id','title','slug','price','discount','stock','quantity','unit_id','short_description','description','status','created_by','updated_by','recommended_product','flash_product','status'];

    public $with = ['images','attributes'];
    function  category(){
        return $this->belongsTo(Category::class);
    }

    function  subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    function  unit(){
        return $this->belongsTo(Unit::class);
    }

    function  createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    function  updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }

    function  images(){
        return $this->hasMany(ProductImage::class);
    }

    function  attributes(){
        return $this->hasMany(ProductAttribute::class);
    }
}
