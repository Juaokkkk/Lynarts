<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_style',
        'id_size',
        'description',
        'path',
        'updated_at',
        'active',
    ];

    public function SalesClothing(){
        return $this->hasMany('App\Models\SalesClothing');
    }

    public function Style(){
        return $this->belongsTo('App\Models\Style');
    }

    public function Size(){
        return $this->belongsTo('App\Models\Size');
    }

}
