<?php

namespace App\Http\Controllers;

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
        $gs = DB::table('gs')
            ->join('users', 'users.id', '=', 'uid')
            ->select('gs.*', 'users.*')
            ->get();
        $data = [
            'tab' => 'Data Person',
            'pages' => 'Guru & Staff',
            'gs' => $gs,
        ];
        return view('panelpage.admin.gs', $data);
    }

    public function edit_gs( Request $request, $uid): View|Factory|Application
    {
        $user = DB::table('gs')
            ->where('uid', $uid)
            ->join('users', 'users.id', '=', 'uid')
            ->select('users.*', 'gs.*')
            ->first();
        $data = [
            'tab' => 'Data Person',
            'pages' => 'Guru & Staff',
            'gs' => $user,
        ];
//        dd($user);
        return view('panelpage.admin.gs-edit', $data);
    }
}
