<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesClothing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sale',
        'id_clothing',
        'amount',
        'updated_at',
        'active',
    ];

    public function Sale(){
        return $this->belongsTo('App\Models\Sales\Sale');
    }

    public function Clothes(){
        return $this->belongsTo('App\Models\Products\Clothes');
    }

}
