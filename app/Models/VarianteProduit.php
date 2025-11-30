<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class VarianteProduit extends Model
{
    protected $table = 'variante_produits';
    protected $guarded = [];

    // Relation : appartient à un produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
