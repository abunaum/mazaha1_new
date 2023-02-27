<?php

namespace App\Http\Controllers;

use App\Models\jenis_program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisProgramController extends Controller
{
    private string $pageview;

    public function __construct()
    {
        $this->pageview = 'panelpage.admin.program.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $jp = jenis_program::all();
        $data = [
            'tab' => 'Program',
            'pages' => 'Jenis Program',
            'jp' => $jp,
        ];
        return view($this->pageview .'index', $data);
    }

    public function create(): Response
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        jenis_program::create([
            'nama' => $request->nama,
        ]);
        return back()->with('sukses', 'Berhasil menambahkan jenis program baru');
    }

    /**
     * Display the specified resource.
     *
     * @param jenis_program $jenis_program
     */
    public function show(jenis_program $jenis_program): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param jenis_program $jenis_program
     */
    public function edit(jenis_program $jenis_program): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param jenis_program $jenis_program
     */
    public function update(Request $request, jenis_program $jenis_program): RedirectResponse
    {
        $nama_baru = $request->nama;
        $nama_lama = $jenis_program->nama;
        jenis_program::where('id', $jenis_program->id)->update([
            'nama' => $nama_baru,
        ]);
        return back()->with('sukses', 'Berhasil mengubah nama jenis program dari ' . $nama_lama . ' menjadi ' . $nama_baru);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param jenis_program $jenis_program
     */
    public function destroy(jenis_program $jenis_program): RedirectResponse
    {
        jenis_program::destroy($jenis_program->id);
        return back()->with('sukses', 'Berhasil menghapus jenis program ' . $jenis_program->nama);
    }
}
