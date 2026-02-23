<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sale',
        'id_method',
        'deadline',
        'installmentValue',
        'updated_at',
        'active',
    ];

    public function Sale(){
        return $this->belongsTo('App\Sales\Models\Sale');
    }

    public function Method(){
        return $this->belongsTo('App\Sales\Models\Method');
    }

}