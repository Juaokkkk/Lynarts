<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Nome da tabela conforme sua imagem
    protected $table = 'sales';

    protected $fillable = [
        'id_user',
        'id_customer',
        'totalValue',
        'situation',
        'active',
    ];

    // Relacionamento com os itens da venda
    public function SalesClothing()
    {
        return $this->hasMany(SalesClothing::class, 'id_sale');
    }

    // Relacionamento com o Vendedor
    public function User()
    {
        return $this->belongsTo(\App\Models\Entities\User::class, 'id_user');
    }

    // Relacionamento com o Cliente
    public function Customer()
    {
        return $this->belongsTo(\App\Models\Entities\Customer::class, 'id_customer');
    }
}