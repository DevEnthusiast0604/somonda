<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function sales(){
        return $this->hasMany('App\Models\Sale');
    }

    public function detail(){
        return $this->hasOne('App\Models\Productdetail');
    }
}
