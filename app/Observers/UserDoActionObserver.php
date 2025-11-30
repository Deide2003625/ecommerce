<?php
namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserDoActionObserver
{
    public function creating($model)
    {
        $this->setDoAnAction();
    }

    public function updating($model)
    {
        $this->setDoAnAction();
    }

    protected function setDoAnAction()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->do_an_action) {
                $user->do_an_action = true;
                $user->save();
            }
        }
    }
}
