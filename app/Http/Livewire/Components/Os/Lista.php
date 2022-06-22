<?php

namespace App\Http\Livewire\Components\Os;

use App\Models\OS;
use Livewire\Component;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.components.os.lista', [
            'os' => OS::paginate(30)
        ]);
    }
}
