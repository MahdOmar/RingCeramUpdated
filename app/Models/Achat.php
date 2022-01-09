<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    Protected $dateFormat = 'Y-m-d';
    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
