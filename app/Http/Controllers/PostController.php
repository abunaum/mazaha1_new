<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\categories;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): Application|Factory|View
    {
        $data = [
            'tab' => 'Blog',
            'pages' => 'Semua Post',
        ];
        return view('post.allpost', $data);
    }

    public function create(): View|Factory|Application
    {
        $data = [
            'tab' => 'Blog',
            'pages' => 'Tambah Post',
            'categories' => categories::all(),
        ];
        return view('post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = [
            'judul' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255',
            'kategori' => 'required',
            'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
            'time' => 'required',
        ];
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah post gagal!')->withErrors($validator)->withInput();
        }
        $excerpt = str_replace("&nbsp;", " ", Str::limit(strip_tags($request->body), 350, '...'));
        $post = [
            'categori' => $request->kategori,
            'author' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $request->slug,
            'excerpt' => $excerpt,
            'body' => $request->body,
            'created_at' => $request->time,
        ];


        if ($request->file('gambar')) {
            try {
                $post['gambar'] = $request->file('gambar')->store('gambar-post');
            } catch (\Throwable $th) {
                return back()->with('error', 'Post gagal ditambahkan! <br> '.'Gagal Upload gambar');
            }
        } else {
            $post['gambar'] = 'default-post.jpg';
        }
        Post::create($post);
        return back()->with('sukses', 'Post berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Factory|View|RedirectResponse|Application
     */
    public function edit(Post $post): Factory|View|RedirectResponse|Application
    {
        $postfull = Post::join('categories', 'categories.id', '=', 'posts.categori')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'categories.nama as nama_kategori', 'users.name as nama_author')
            ->where('posts.id', $post->id)
            ->first();
        if (!$postfull) {
            return back()->with('error', 'Post tidak ditemukan!');
        }
        $data = [
            'tab' => 'Blog',
            'pages' => 'Edit Post',
            'categories' => categories::all(),
            'post' => $postfull,
        ];
        return view('post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        if (!$post) {
            return back()->with('error', 'Post tidak ditemukan!');
        }
        $idpost = $post->id;
        $gambarpost = $post->gambar;
        $slugpost = $post->slug;
        $valid = [
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
            'time' => 'required',
        ];
        if ($request->slug != $slugpost) {
            $valid['slug'] = 'required|unique:posts|max:255';
        }
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah post gagal!')->withErrors($validator)->withInput();
        }
        $excerpt = str_replace("&nbsp;", " ", Str::limit(strip_tags($request->body), 350, '...'));
        $post = [
            'categori' => $request->kategori,
            'author' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $request->slug,
            'excerpt' => $excerpt,
            'body' => $request->body,
            'created_at' => $request->time,
        ];


        if ($request->file('gambar')) {
            if ($gambarpost != 'default-post.jpg') {
                try {
                    Storage::delete($gambarpost);
                    $post['gambar'] = $request->file('gambar')->store('gambar-post');
                } catch (\Throwable $th) {
                    return back()->with('error', 'Post gagal ditambahkan! <br> '.'Gagal Hapus Gambar Lama');
                }
            } else {
                try {

                    $post['gambar'] = $request->file('gambar')->store('gambar-post');
                } catch (\Throwable $th) {
                    return back()->with('error', 'Post gagal ditambahkan! <br> '.'Gagal Upload ke Gdrive');
                }
            }
        }
        Post::where('id', $idpost)->update($post);
        return back()->with('sukses', 'Post berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        if (!$post) {
            return back()->with('error', 'Post tidak ditemukan!');
        }
        $image = $post->gambar;
        if ($image != 'default-post.jpg'){
            Storage::delete($image);
        }
        Post::destroy($post->id);
        return back()->with('sukses', 'Post berhasil dihapus!');
    }

    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
