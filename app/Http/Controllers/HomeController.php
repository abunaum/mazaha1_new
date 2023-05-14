<?php

namespace App\Http\Controllers;

use App\Models\gs;
use App\Models\Post;
use App\Models\program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $data = [
            'pages' => 'home',
        ];
        return view('home', $data);
    }

    public function profile(): Factory|View|Application
    {
        $data = [
            'pages' => 'profile',
        ];
        return view('profile', $data);
    }

    public function visi_misi(): Factory|View|Application
    {
        $data = [
            'pages' => 'visi-misi',
        ];
        return view('visi-misi', $data);
    }

    public function tenaga_pendidik(): Factory|View|Application
    {
        $gs = gs::cari(request(['cari']))
            ->where('jabatan', 'LIKE', 'GURU')
            ->orWhere('jabatan', 'LIKE', 'KEPALA MADRASAH')
            ->paginate(10)
            ->withQueryString();
        $data = [
            'pages' => 'tenaga-pendidik',
            'gs' => $gs,
        ];
        return view('tenaga-pendidik', $data);
    }

    public function tenaga_kependidikan(): Factory|View|Application
    {
        $gs = gs::cari(request(['cari']))
            ->where('jabatan', '!=', 'GURU')
            ->paginate(10)
            ->withQueryString();
        $data = [
            'pages' => 'tenaga-kependidikan',
            'gs' => $gs,
        ];
        return view('tenaga-kependidikan', $data);
    }

    public function ppdb(): Factory|View|Application
    {
        $data = [
            'pages' => 'ppdb',
        ];
        return view('ppdb', $data);
    }

    public function berita(): Factory|View|Application
    {
        $data = [
            'pages' => 'berita',
            'paginate' => 7,
        ];
        return view('berita', $data);
    }

    public function berita_detail($slug): View|Factory|Application
    {
        $posts = Post::join('categories', 'categories.id', '=', 'posts.categori')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'categories.nama as nama_kategori', 'users.name as nama_author')
            ->where('posts.slug', $slug)
            ->first();
        if (!$posts) {
            return abort(404);
        }
        $data = [
            'pages' => 'berita',
            'posts' => $posts,
        ];
        return view('berita-detail', $data);
    }

    public function view_image(Request $request): Response|Application|ResponseFactory
    {
        $request->query('location');
        if (!empty($request->query('location'))) {
            $lokasi = $request->query('location');
            $gambar = Storage::get($lokasi);
            if ($gambar == null) {
                return abort(404);
            } else {
                return response($gambar, 200)->header('Content-Type', '.jpg');
            }
        } else {
            return abort(404);
        }
    }

    public function pesan(Request $request)
    {
        $valid = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            return back()->with('error', 'Pesan gagal dikirim!')->withErrors($validator)->withInput();
        }
        return back()->with('sukses', 'Pesan berhasil dikirim!');
    }

    public function kontak(): Factory|View|Application
    {
        $data = [
            'pages' => 'kontak',
        ];
        return view('kontak', $data);
    }

    public function sambutan(): Factory|View|Application
    {
        $data = [
            'pages' => 'sambutan',
        ];
        return view('sambutan', $data);
    }

    public function sejarah(): Factory|View|Application
    {
        $data = [
            'pages' => 'sejarah',
        ];
        return view('sejarah', $data);
    }

    public function sarpras(): Factory|View|Application
    {
        $data = [
            'pages' => 'sarpras',
        ];
        return view('sarpras', $data);
    }

    public function program(): View|Factory|Application
    {
        $extra = [
            [
                'image' => 'pramuka.jpg',
                'title' => 'Pramuka',
            ],
            [
                'image' => 'reactjs.jpg',
                'title' => 'KIR',
            ],
            [
                'image' => 'al-quran.png',
                'title' => 'Tartilul Qur\'an',
            ],
            [
                'image' => 'silat.jpg',
                'title' => 'Pagar Nusa',
            ],
            [
                'image' => 'english_club.jpg',
                'title' => 'English Club',
            ],
            [
                'image' => 'arabic.jpg',
                'title' => 'Arabic Club',
            ],
            [
                'image' => 'piala.jpg',
                'title' => 'Kelas Olimpiade',
            ]

        ];
        $data = [
            'pages' => 'program',
            'extra' => $extra,
        ];
        return view('program', $data);
    }


    public function struktur_organisasi(): Factory|View|Application
    {
        $data = [
            'pages' => 'struktur-organisasi',
        ];
        return view('struktur-organisasi', $data);
    }
}
