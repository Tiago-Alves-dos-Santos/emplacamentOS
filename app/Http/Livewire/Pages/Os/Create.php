<?php

namespace App\Http\Livewire\Pages\Os;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.os.create')
        ->extends('layouts.admin', ['page_active' => 'os.create'])
        ->section('conteudo');
    }
}
