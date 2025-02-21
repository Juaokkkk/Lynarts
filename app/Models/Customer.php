<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'updated_at',
        'active',
    ];

    public function Number(){
        return $this->hasMany('App\Models\Number');
    }

    public function Address(){
        return $this->hasMany('App\Models\Address');
    }

    public function Sale(){
        return $this->hasMany('App\Models\Sale');
    }

}
