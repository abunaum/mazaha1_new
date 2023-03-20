<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Yajra\DataTables\Facades\DataTables;

class APIController extends Controller
{
    public function get_post(): Response|Application|ResponseFactory
    {
        $posts = Post::latest()
            ->join('categories', 'categories.id', '=', 'posts.categori')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'categories.nama as categori', 'users.name as author')
            ->first();
        $postnya = [
            'judul' => $posts['judul'],
            'excerpt' => $posts['excerpt'],
            'gambar' => url('view-image?location=') . $posts['gambar'],
            'slug' => $posts['slug'],
            'categori' => $posts['categori'],
            'author' => $posts['author'],
            'link' => url('berita/detail') . '/' . $posts['slug'],
            'created_at' => $posts['created_at']
        ];
        return response($postnya, 200);
    }

    public function blog(): JsonResponse
    {
        $post = Post::latest()
            ->join('categories', 'categories.id', '=', 'posts.categori')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'categories.nama as categori', 'users.name as author')
            ->get();
        return DataTables::of($post)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="btn btn-sm btn-warning d-inline m-1" href="' . route('post-edit', $row->id) . '">Edit</a>';
                $actionBtn .= '<a class="btn btn-sm btn-danger d-inline m-1" href="' . route('post-destroy', $row->id) . '">Hapus</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function blog_front(Request $request): JsonResponse
    {
        $post = Post::latest()
            ->join('categories', 'categories.id', '=', 'posts.categori')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'categories.nama as categori', 'users.name as author');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $post->where(function ($q) use ($search) {
                $q->Where('judul', 'like', '%' . $search . '%')
                    ->orWhere('categories.nama', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('type') && !empty($request->type && $request->has('nama') && !empty($request->nama))) {
            $type = $request->type;
            $nama = $request->nama;
            if ($type == 'kategori'){
                $type = 'categories.nama';
            } else {
                $type = 'users.name';
            }
            $post->where(function ($q) use ($type, $nama) {
                $q->Where($type, 'like', '%' . $nama . '%');
            });
        }


        $posts = $post->latest()->paginate($request->paginate ?? 10);
        $pagination = [
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'from' => $posts->firstItem(),
                'to' => $posts->lastItem(),
            ],
        ];

        $response = array_merge($posts->toArray(), $pagination);

        return response()->json($response);
    }
}
