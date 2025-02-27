<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'updated_at',
        'active',
    ];

    public function Clothes(){
        return $this->hasMany('App\Models\Products\Clothes');
    }
}
