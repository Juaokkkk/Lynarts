<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'road',
        'neighborhood',
        'city',
        'cep',
        'complement',
        'updated_at',
        'active',
    ];


    public function Customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
