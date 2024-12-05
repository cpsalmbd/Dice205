<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class UserList extends Component
{
    public int $offset = 0;
    public $users = [];
    public function render(): View
    {
        return view('livewire.user-list');
    }

    #[Computed()]
    public function userCount()
    {
        return User::whereNot('id', auth()->id())->count();
    }

    public function loadMore()
    {
        $this->offset = count($this->users);
        array_push($this->users, ...User::withCount(['likes'])->whereNot('id', auth()->id())->orderByDesc('id')->offset($this->offset)->take(5)->get()->toArray());
    }

}
