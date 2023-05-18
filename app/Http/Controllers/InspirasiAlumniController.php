<?php

namespace App\Http\Controllers;

use App\Models\InspirasiAlumni;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\ValidationTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InspirasiAlumniController extends Controller
{
    use ValidationTrait;
    use ImageTrait;

    private string $pageview;

    public function __construct()
    {
        $this->pageview = 'panelpage.media.inspirasi.';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        $data = [
            'tab' => 'Inspirasi',
            'pages' => 'Inspirasi Alumni',
        ];
        return view($this->pageview . 'alumni', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        $data = [
            'tab' => 'Inspirasi',
            'pages' => 'Tambah Inspirasi Alumni',
        ];
        return view($this->pageview . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = [
            'judul' => 'required|max:255',
            'slug' => 'required|unique:inspirasi_alumnis|max:255',
            'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
            'time' => 'required',
        ];
        $validator = $this->validateData($request->all(), $valid);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah inspirasi gagal!')->withErrors($validator)->withInput();
        }
        $excerpt = str_replace("&nbsp;", " ", Str::limit(strip_tags($request->body), 350, '...'));
        $inspirasi = [
            'author' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $request->slug,
            'excerpt' => $excerpt,
            'body' => $request->body,
            'created_at' => $request->time,
        ];

        if ($request->file('gambar')) {
            try {
                $inspirasi['gambar'] = $request->file('gambar')->store('gambar-inspirasi');
            } catch (\Throwable $th) {
                return back()->with('error', 'Post gagal ditambahkan! <br> ' . 'Gagal Upload gambar');
            }
        } else {
            $inspirasi['gambar'] = 'default-post.jpg';
        }
        InspirasiAlumni::create($inspirasi);
        return redirect()->route('inspirasi-alumni')->with('sukses', 'Inspirasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InspirasiAlumni $inspirasiAlumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $inspirasifull = InspirasiAlumni::with('user')
            ->where('id', $id)
            ->first();
        if (!$inspirasifull) {
            return back()->with('error', 'Inspirasi tidak ditemukan!');
        }
        $data = [
            'tab' => 'Inspirasi',
            'pages' => 'Inspirasi Alumni',
            'inspirasi' => $inspirasifull,
        ];
        return view($this->pageview . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inspirasiAlumni = InspirasiAlumni::with('user')
            ->where('id', $id)
            ->first();
        if (!$inspirasiAlumni) {
            return back()->with('error', 'Inspirasi tidak ditemukan!');
        }
        $idinspirasi = $inspirasiAlumni->id;
        $gambarinspirasi = $inspirasiAlumni->gambar;
        $sluginspirasi = $inspirasiAlumni->slug;
        $valid = [
            'judul' => 'required|max:255',
            'body' => 'required',
            'time' => 'required',
        ];
        if ($request->file('gambar')) {
            $valid['gambar'] = 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg';
        }
        if ($request->slug != $sluginspirasi) {
            $valid['slug'] = 'required|unique:inspirasi_alumnis|max:255';
        }
        $validator = $this->validateData($request->all(), $valid);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->with('error', 'Edit inspirasi gagal!')->withErrors($validator)->withInput();
        }
        $excerpt = str_replace("&nbsp;", " ", Str::limit(strip_tags($request->body), 350, '...'));
        $inspirasiAlumni = [
            'author' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $request->slug,
            'excerpt' => $excerpt,
            'body' => $request->body,
            'created_at' => $request->time,
        ];
        if ($request->file('gambar')) {
            $cekgambar = $this->imageCheck('default-post.jpg', $request->file('gambar'), $gambarinspirasi, 'gambar-inspirasi');
            if ($cekgambar === false) {
                return back()->with('error', 'Edit inspirasi gagal! <br> ' . 'Gagal Upload gambar');
            } else {
                $inspirasiAlumni['gambar'] = $cekgambar;
            }
        }
        InspirasiAlumni::where('id', $idinspirasi)->update($inspirasiAlumni);
        return redirect()->route('inspirasi-alumni')->with('sukses', 'Inspirasi berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $alumni = InspirasiAlumni::with('user')
            ->where('id', $id)
            ->first();
        if (!$alumni) {
            return back()->with('error', 'Inspirasi tidak ditemukan!');
        }
        $image = $alumni->gambar;
        if ($image != 'default-post.jpg') {
            Storage::delete($image);
        }
        $alumni->delete();
        return back()->with('sukses', 'Inspirasi berhasil dihapus!');
    }

    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(InspirasiAlumni::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
