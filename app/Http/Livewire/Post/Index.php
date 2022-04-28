<?php

namespace App\Http\Livewire\Post;

use App\Models\Gudang;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $data = Gudang::all();
        $no = 1;

        return view('livewire.post.index', compact(
            'data',
            'no'
        ));
        
    }
}
