<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variants extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function attribute(){
        return $this->belongsTo(Attributes::class, 'attribute_id', 'id');
    }
    public function attribute_item(){
        return $this->belongsTo(Attribute_items::class, 'attribute_item_id', 'id');
    }

    public function attribute_item_new(){
        return $this->hasMany(Attribute_items::class, 'id', 'attribute_item_id');
    }

    public function color(){
        return $this->belongsTo(Colors::class, 'color_id', 'id');
    }
}
