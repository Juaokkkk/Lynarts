<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_style',
        'id_size',
        'description',
        'path',
        'price',
        'amount',
        'updated_at',
        'active',
    ];

    public function SalesClothing(){
        return $this->hasMany('App\Models\Sales\SalesClothing');
    }

    public function Style(){
        return $this->belongsTo('App\Models\Products\Style');
    }

    public function Size(){
        return $this->belongsTo('App\Models\Products\Size');
    }

}
