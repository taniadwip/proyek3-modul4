<?php

namespace App\Observers;

use App\Models\User;   
use App\Observers\UserObserver;                 
use Illuminate\Support\Facades\Log;     
use Illuminate\Support\Facades\Auth;    

class UserObserver
{
    


    public function updated(User $user): void
    {
        
        if (! $user->wasChanged('role')) return;

        
        Log::info('user.role.changed', [
            'target_user_id' => $user->id,
            'old_role'       => $user->getRawOriginal('role'),
            'new_role'       => $user->role,
            'actor_id'       => Auth::id(),
        ]);
    }
}