<?php

namespace App\Http\Controllers;

use App\Models\jenis_program;
use App\Models\program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    private string $pageview;

    public function __construct()
    {
        $this->pageview = 'panelpage.admin.program.';
    }

    public function index(): Factory|View|Application
    {
        $p = program::join('jenis_program', 'jenis_program.id', '=', 'programs.jenis_program_id')
            ->select('programs.*', 'jenis_program.nama as jenis_program')
            ->get();
        $data = [
            'tab' => 'Program',
            'pages' => 'Semua Program',
            'program' => $p,
        ];
        return view($this->pageview . 'list-program', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        $data = [
            'tab' => 'Program',
            'pages' => 'Semua Program',
            'jp' => jenis_program::all(),
        ];
        return view($this->pageview . 'create-program', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = [
            'nama' => 'required|max:255',
            'jenis' => 'required',
            'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
        ];
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah program gagal!')->withErrors($validator)->withInput();
        }
        $program = [
            'jenis_program_id' => $request->jenis,
            'nama' => $request->nama,
            'deskripsi' => $request->body,
        ];
        if ($request->file('gambar')) {
            try {
                $program['gambar'] = $request->file('gambar')->store('gambar-program');
            } catch (\Throwable $th) {
                return back()->with('error', 'Program gagal ditambahkan! <br> ' . 'Gagal Upload Gambar');
            }
        }

        program::create($program);
        return back()->with('success', 'Program berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(program $program): Factory|View|Application
    {
        $program = program::where('programs.id', $program->id)
            ->join('jenis_program', 'jenis_program.id', '=', 'programs.jenis_program_id')
            ->select('programs.*', 'jenis_program.nama as jenis_program')
            ->first();
        $data = [
            'tab' => 'Program',
            'pages' => 'Semua Program',
            'jp' => jenis_program::all(),
            'program' => $program,
        ];
        return view($this->pageview . 'edit-program', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, program $program): RedirectResponse
    {
        $idprogram = $program->id;
        $gambarprogram = $program->gambar;
        $valid = [
            'nama' => 'required|max:255',
            'jenis' => 'required',
            'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
        ];
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return back()->with('error', 'Edit program gagal')->withErrors($validator)->withInput();
        }

        $dp = [
            'jenis_program_id' => $request->jenis,
            'nama' => $request->nama,
            'deskripsi' => $request->body,
        ];
        if ($request->file('gambar')) {
            if ($gambarprogram != null) {
                try {
                    Storage::delete($gambarprogram);
                    $dp['gambar'] = $request->file('gambar')->store('gambar-program');
                } catch (\Throwable $th) {
                    return back()->with('error', 'Program gagal di edit! <br> '.'Gagal Hapus Gambar Lama');
                }
            } else {
                try {

                    $dp['gambar'] = $request->file('gambar')->store('gambar-post');
                } catch (\Throwable $th) {
                    return back()->with('error', 'Program gagal di edit! <br> '.'Gagal Upload gambar');
                }
            }
        }
        program::where('programs.id', $idprogram)->update($dp);
        return back()->with('sukses', 'Program berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(program $program): RedirectResponse
    {
        $image = $program->gambar;
        if ($image != null){
            Storage::delete($image);
        }
        program::destroy($program->id);
        return back()->with('sukses', 'Program berhasil dihapus!');
    }
}
