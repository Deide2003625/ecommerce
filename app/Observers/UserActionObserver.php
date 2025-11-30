<?php
namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class UserActionObserver
{
    public function creating($model)
    {
        if (Auth::check()) {
            $model->inserted_by = Auth::id();
        }
    }

    public function updating($model)
    {
        if (Auth::check()) {
            $model->updated_by = Auth::id();
        }
    }
}
