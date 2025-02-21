<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tax',
        'updated_at',
        'active',
    ];

    public function SalesMethod(){
        return $this->hasMany('App\Models\SaleMethod');
    }

}
