<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeLayout extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('layouts.home-layout');
    }
}
