<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ValeurOption extends Model
{
    protected $table = 'valeur_options';
    protected $guarded = [];

    // Relation : appartient à une option produit
    public function optionProduit()
    {
        return $this->belongsTo(OptionProduit::class);
    }
}
