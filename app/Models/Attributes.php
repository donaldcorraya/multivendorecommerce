<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function attribute_items(){
        return $this->hasMany(Attribute_items::class, 'attribute_id', 'id');
    }
}
