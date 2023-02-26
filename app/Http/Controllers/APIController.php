<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

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
            'link' => url('berita/detail'). '/' . $posts['slug'],
            'created_at' => $posts['created_at']
        ];
        return response($postnya, 200);
    }
}
