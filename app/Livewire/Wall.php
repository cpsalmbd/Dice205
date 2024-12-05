<?php

namespace App\Livewire;

use App\Models\Like;
use App\Services\API;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Wall extends Component
{
    use LivewireAlert;

    public bool $loading;
    public array $likes;
    public int $offset = 0;
    public int $limit = 2;

    public function init()
    {
        $this->loading = true;
    }

    #[Computed()]
    public function data(): Array
    {
        $data = (new API)->getData(config('api.dogs'));
        [ $dogs ] = array_values(json_decode($data, true));
        $data = [];
        $limit = $this->limit + $this->offset;
        $iterator = $this->offset;

        foreach($dogs as $breed => $types){
            if($iterator < $limit){
                array_push($data, (new Fluent([
                    'name' => $breed,
                    // 'image' => json_decode((new API)->getData(str_replace(":name:", $breed, config('api.dog_image'))))->message,
                    'image' => json_decode((new API)->getData(config('api.dog_random_image')))->message,
                    // 'image' => 'https://images.dog.ceo/breeds/australian-kelpie/Resized_20200214_191118_346649120350209.jpg',

                ])));
                // if($types){
                //     foreach($types as $type){
                //         array_push($data, (new Fluent([
                //             'name' => $breed . '-' . $type,
                //             'image' => 'https://images.dog.ceo/breeds/australian-kelpie/Resized_20200214_191118_346649120350209.jpg',
                //         ])));
                //     }
                // }
            }
            $iterator++;
        }
        return $data;
    }

    public function loadMore()
    {
        $this->limit += 3;
    }

    public function render(): View
    {
        $this->likes = Auth::user()
            ->likes()
            ->pluck('name')
            ->toArray();
        return view('livewire.wall');
    }

    public function react($name): Void
    {
        $data = Like::where('user_id', Auth::id())->where('name', $name)->first();
        if($data){
            Like::where('user_id', Auth::id())->where('name', $name)->delete();
        } else {
            if(count($this->likes) <= 2){
                $data = new Like;
                $data->user_id = Auth::id();
                $data->name = $name;
                $data->save();
                // $this->alert('success', 'You like ' . $name, [
                //     'toast' => true
                // ]);
                // $this->dispatch('$refresh');
            } else {
                $this->alert('warning', 'Maximum liked dogs reached!', [
                    'toast' => true
                ]);
            }
        }
    }


}


