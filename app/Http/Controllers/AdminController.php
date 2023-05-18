<?php

namespace App\Http\Controllers;

use App\Models\gs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;


class AdminController extends Controller
{
    public function guru_staff(): View|Factory|Application
    {
        $data = [
            'tab' => 'Data Person',
            'pages' => 'Guru & Staff',
        ];
        return view('panelpage.admin.gs', $data);
    }

    public function edit_gs( Request $request, $id): View|Factory|Application
    {
        $user = gs::with('profile')->where('id', $id)->first();
        $data = [
            'tab' => 'Data Person',
            'pages' => 'Guru & Staff',
            'gs' => $user,
        ];
//        dd($user);
        return view('panelpage.admin.gs-edit', $data);
    }
}
