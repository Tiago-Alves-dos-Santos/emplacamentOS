<?php

namespace App\Http\Livewire\Pages\Os;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.os.dashboard')
        ->extends('layouts.admin', ['page_active' => 'os.dashboard'])
        ->section('conteudo');
    }
}
