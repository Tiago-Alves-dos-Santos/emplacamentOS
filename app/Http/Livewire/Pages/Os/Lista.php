<?php

namespace App\Http\Livewire\Pages\Os;

use Livewire\Component;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.pages.os.lista')
        ->extends('layouts.admin', ['page_active' => 'os.lista'])
        ->section('conteudo');
    }
}
