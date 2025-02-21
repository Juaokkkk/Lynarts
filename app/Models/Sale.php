<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_customer',
        'totalValue',
        'situation',
        'updated_at',
        'active',
    ];

    public function SalesClothing(){
        return $this->hasMany('App\Models\SalesClothing');
    }

    public function SalesMethod(){
        return $this->hasMany('App\Models\SalesMethod');
    }

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
