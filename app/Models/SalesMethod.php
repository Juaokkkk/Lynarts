<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Sale');
    }

    public function Method(){
        return $this->belongsTo('App\Models\Method');
    }

}