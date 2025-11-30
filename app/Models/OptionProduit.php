<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OptionProduit extends Model
{
    protected $table = 'option_produits';
    protected $guarded = [];

    // Relation : appartient à un produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // Relation : valeurs de l'option
    public function valeurs()
    {
        return $this->hasMany(ValeurOption::class);
    }
}
