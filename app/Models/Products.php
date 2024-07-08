<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product_variant(){
        return $this->hasMany(Product_variants::class, 'product_id', 'id');
    }

    public function image_gallery(){
        return $this->hasMany(Image_gallery::class, 'product_id', 'id');
    }
}
