<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'session_id', // pour identifier le panier de l'utilisateur
    ];

    // 🔗 Relation : un élément de panier appartient à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
