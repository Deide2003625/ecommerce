<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Produit extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'produits';
    protected $guarded = [];

    // Relation : appartient à une sous-catégorie
    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, 'sous_categorie_id');
    }

    // Relation : options du produit
    public function options()
    {
        return $this->hasMany(OptionProduit::class);
    }

    // Relation : variantes du produit
    public function variantes()
    {
        return $this->hasMany(VarianteProduit::class);
    }
}
