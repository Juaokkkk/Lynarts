<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Sale');
    }

    public function Clothes(){
        return $this->belongsTo('App\Models\Clothes');
    }

}
