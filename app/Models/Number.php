<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'DDD',
        'number',
        'updated_at',
        'active',
    ];

    public function Customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
