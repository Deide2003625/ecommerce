<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model

{
    protected $table = 'sous_categories';
    protected $guarded = [];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    public function produits()
    {
        return $this->hasMany(Produit::class, 'sous_categorie_id');
    }
}
