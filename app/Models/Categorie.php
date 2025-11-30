<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Categorie extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'categories';
    protected $guarded = [];
     public function subCategories()
    {
        return $this->hasMany(SousCategorie::class, 'categorie_id');
    }
}
