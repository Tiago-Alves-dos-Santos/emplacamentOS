<?php

namespace App\Http\Livewire\Pages\Taxa;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.taxa.dashboard')
        ->extends('layouts.admin', ['page_active' => 'taxa.dashboard'])
        ->section('conteudo');
    }
}
