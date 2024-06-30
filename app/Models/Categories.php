<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function parent_category(){
        return $this->belongsTo(Categories::class, 'parent_category_id', 'id');
    }

    public function parent_category_hasMany(){
        return $this->hasMany(Categories::class, 'parent_category_id', 'id');
    }


    public function children(){
        return $this->hasMany(Categories::class, 'parent_category_id');
    }

    public function childrenRecursive(){
        return $this->children()->with('childrenRecursive');
    }
}
