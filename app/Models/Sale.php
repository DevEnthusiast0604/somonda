<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

   public function product(){
      return $this->belongsTo('App\Models\Product');
   }

   public function user(){
       return $this->belongsTo('App\Models\User');
   }

   public function order(){
      return $this->hasOne('App\Models\Order');
   }
}
