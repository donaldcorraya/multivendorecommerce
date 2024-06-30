<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_attribute extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function attribute(){
        return $this->hasMany(Attributes::class, 'id', 'attribute_id');
    }
}
