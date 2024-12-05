<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{
    public int $id;
    public $profile;

    public function render()
    {
        $this->profile = User::with(['likes'])->find($this->id);
        return view('livewire.user-profile');
    }


}
