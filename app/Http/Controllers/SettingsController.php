<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function profile()
    {
        $this->linkPrev = 'Inicio';
        $this->linkCurrent = 'Mi Perfil';
        return view('modules.settings.profile', ['linkPrev' => $this->linkPrev, 'linkCurrent' => $this->linkCurrent]);
    }

    public function appearance()
    {
        $this->linkPrev = 'Inicio';
        $this->linkCurrent = 'Apariencia';
        return view('modules.settings.appearance', ['linkPrev' => $this->linkPrev, 'linkCurrent' => $this->linkCurrent]);
    }

    public function password()
    {
        $this->linkPrev = 'Inicio';
        $this->linkCurrent = 'Cambio contraseña';
        return view('modules.settings.password', ['linkPrev' => $this->linkPrev, 'linkCurrent' => $this->linkCurrent]);
    }
}