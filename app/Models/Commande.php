<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'livreur_id',
        'date_livraison',
        'statut',
        'total',
        'notes',
    ];

    protected $casts = [
        'date_livraison' => 'datetime',
        'total' => 'decimal:2',
    ];

    /**
     * Relation avec le client (utilisateur avec le rôle client)
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Relation avec le livreur (utilisateur avec le rôle livreur)
     */
    public function livreur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'livreur_id');
    }

    /**
     * Relation avec les articles de la commande
     */
    public function items(): HasMany
    {
        return $this->hasMany(CommandeItem::class);
    }

    /**
     * Vérifie si la commande peut être modifiée
     */
    public function peutEtreModifiee(): bool
    {
        return !in_array($this->statut, ['livree', 'annulee']);
    }

    /**
     * Vérifie si la commande peut être annulée
     */
    public function peutEtreAnnulee(): bool
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Calcule le total de la commande
     */
    public function calculerTotal(): float
    {
        return $this->items->sum(function ($item) {
            return $item->quantite * $item->prix_unitaire;
        });
    }
}
