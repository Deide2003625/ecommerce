<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class UserData extends Model
{
    //

    use HasFactory;
    use HasRoles;

    protected $table = 'users';

    // Guard Spatie utilisé pour ce modèle (doit correspondre à guard_name des rôles)
    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Relation avec les rôles
     */
    public function roles()
    {
        return $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            'model_id',
            'role_id'
        );
    }
}
