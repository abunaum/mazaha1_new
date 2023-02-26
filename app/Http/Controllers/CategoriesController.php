<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use App\Models\categories;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(): Factory|View|Application
    {
        $kategori = categories::all();
        $data = [
            'tab' => 'Blog',
            'pages' => 'Kategori',
            'kategori' => $kategori,
        ];
        return view('post.kategori', $data);
    }

    public function create(): Response
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorecategoriesRequest  $request
     */
    public function store(StorecategoriesRequest $request): RedirectResponse
    {
        $valid = [
            'nama' => 'required',
        ];
        $validator = Validator::make($request->all(),$valid);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah kategori gagal!')->withErrors($validator)->withInput();
        }
        $nama = $request->nama;
        categories::create([
            'nama' => $nama,
        ]);
        return back()->with('sukses', 'Tambah kategori berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param categories $categories
     */
    public function show(categories $categories): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param categories $categories
     */
    public function edit(categories $categories): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatecategoriesRequest  $request
     * @param categories $categories
     */
    public function update(UpdatecategoriesRequest $request, $categories): RedirectResponse
    {
        $valid = [
            'namabaru' => 'required',
        ];
        $validator = Validator::make($request->all(),$valid);

        if ($validator->fails()) {
            return back()->with('error', 'Edit kategori gagal!')->withErrors($validator)->withInput();
        }
        $nama = $request->namabaru;
        $categories = categories::find($categories);
        $categories->update([
            'nama' => $nama,
        ]);
        return back()->with('sukses', 'Edit kategori berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param categories $categories
     */
    public function destroy($categories): RedirectResponse
    {
        $categories = categories::find($categories);
        $categories->delete();
        return back()->with('sukses', 'Hapus kategori berhasil!');
    }
}
