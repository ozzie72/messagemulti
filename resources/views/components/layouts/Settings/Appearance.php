<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class Appearance extends Component
{
    public $theme; // Valor por defecto

    public function mount()
    {
        // Recuperar el tema de la cookie o usar el preferido por el sistema
        //$this->theme = $param;
    }

    public function updatedTheme($value)
    {
        dd($value);
        $this->theme = $value === 'light' ? 'dark' : 'light';
               
        $this->dispatch('theme-changed', theme: $this->theme);
    }

  
}
