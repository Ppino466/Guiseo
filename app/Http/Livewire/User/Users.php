<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Livewire\Component;

class Users extends Component
{



    public function render()
    {
        return view('livewire.users.users');
    }
}
