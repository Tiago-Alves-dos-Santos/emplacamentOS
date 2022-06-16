<?php

namespace App\Http\Livewire\Components\Os;

use Livewire\Component;

class FormCreate extends Component
{
    protected $listeners = [
        'teste-rl' => '$refresh',
    ];
    public function reload()
    {
        $this->emit('teste-rl');
    }
    public function render()
    {
        return view('livewire.components.os.form-create');
    }
}
