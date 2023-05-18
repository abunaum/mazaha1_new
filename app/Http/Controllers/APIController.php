<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\gs;
use App\Models\InspirasiAlumni;
use App\Models\Post;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Yajra\DataTables\Facades\DataTables;
use OpenAI\Laravel\Facades\OpenAI;

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

    public function inspirasi_alumni(): JsonResponse
    {
        $inspirasi = InspirasiAlumni::latest()
            ->with('user')
            ->get();
        return DataTables::of($inspirasi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $click = "hapus('" . $row->judul . "','form-hps-" . $row->id . "')";
                $actionBtn = '<a class="btn btn-sm btn-warning d-inline m-1" href="' . route('inspirasi-alumni-edit', $row->id) . '">Edit</a>';
                $actionBtn .= '<form id="form-hps-' . $row->id . '" action="' . route('inspirasi-alumni-hapus', $row->id) . '" method="post" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="delete">
                                <button type="button" class="btn btn-sm btn-danger"  onclick="' . $click . '">Hapus</button>
                                </form>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
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
            if ($type == 'kategori') {
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

    public function agenda_front(Request $request)
    {
        $agenda = agenda::orderBy('waktu', 'desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $agenda->where(function ($q) use ($search) {
                $q->Where('judul', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%');
            });
        }
        $agendas = $agenda->paginate($request->paginate ?? 10);
        $pagination = [
            'pagination' => [
                'total' => $agendas->total(),
                'per_page' => $agendas->perPage(),
                'current_page' => $agendas->currentPage(),
                'last_page' => $agendas->lastPage(),
                'from' => $agendas->firstItem(),
                'to' => $agendas->lastItem(),
            ],
        ];

        $response = array_merge($agendas->toArray(), $pagination);

        return response()->json($response);
    }

    public function inspirasi_front(Request $request): JsonResponse
    {
        $inspirasi = InspirasiAlumni::latest()
            ->with('user');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $inspirasi->where(function ($q) use ($search) {
                $q->Where('judul', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->has('type') && !empty($request->type && $request->has('nama') && !empty($request->nama))) {
            if ($request->type == 'author') {
                $nama = $request->nama;
                $inspirasi->where(function ($q) use ($nama) {
                    $q->WhereHas('user', function ($q) use ($nama) {
                        $q->where('name', 'like', '%' . $nama . '%');
                    });
                });
            }
        }


        $posts = $inspirasi->latest()->paginate($request->paginate ?? 10);
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

    /**
     * @throws Exception
     */
    public function gs(): JsonResponse
    {
        $gs = gs::with('profile')
            ->get()
            ->sortBy('nama');
        return DataTables::of($gs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="btn btn-sm btn-warning d-inline m-1" href="' . route('gs-edit', $row->id) . '">Edit</a>';
                $click = "hapus('" . $row->nama . "','form-hps-" . $row->id . "')";
                $actionBtn .= '<form id="form-hps-' . $row->id . '" action="' . route('gs-hapus', $row->id) . '" method="post" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="delete">
                                <button type="button" class="btn btn-sm btn-danger"  onclick="' . $click . '">Hapus</button>
                                </form>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function openai(Request $request): JsonResponse
    {
        $prompt = $request->input('prompt');
        try {
            $result = OpenAI::completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 150,
                'temperature' => 1
            ]);
            $answer = $result['choices'][0]['text'];
            $res = [
                'message' => 'success',
                'jawaban' => $answer,
                'result' => $result->id
            ];
            return response()->json($res);
        } catch (Exception $e) {
            $res = [
                'message' => 'error',
                'jawaban' => 'System : mohon maaf AI ngantuk karena lupa ngopi, sehingga lupa jawab ' . $e->getMessage(),
            ];
            return response()->json($res);
        }
    }
}
