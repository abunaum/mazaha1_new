<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function dashboard(): Factory|View|Application
    {
        $data = [
            'pages' => 'Dashboard',
        ];
        return view('panelpage.dashboard', $data);
    }
}
