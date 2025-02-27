<?php

namespace App\Sales\Models;

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
        return $this->hasMany('App\Models\Sales\SalesClothing');
    }

    public function SalesMethod(){
        return $this->hasMany('App\Models\Sales\SalesMethod');
    }

    public function User(){
        return $this->belongsTo('App\Models\Entities\User');
    }

    public function Customer(){
        return $this->belongsTo('App\Models\Entities\Customer');
    }
}
