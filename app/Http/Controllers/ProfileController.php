<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $user = User::join('profiles', 'profiles.uid', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->first();
        $data = [
            'pages' => 'Profile',
            'user' => $user,
        ];
        return view('panelpage.profile', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $jenis
     * @return RedirectResponse
     */
    public function update(Request $request, $jenis): RedirectResponse
    {
        $user = User::join('profiles', 'profiles.uid', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->select('profiles.*', 'users.*')
            ->first();
        if ($jenis === 'password') {
            $valid = [
                'passwordbaru' => 'required|min:8',
                'ulangipassword' => 'required|same:passwordbaru'
            ];
            $message = [
                'passwordbaru.required' => 'Password Baru wajib di isi.',
                'passwordbaru.min' => 'Password Baru minimal 8 karakter.',
                'ulangipassword.required' => 'Ulangi Password wajib di isi',
                'ulangipassword.same' => 'Password Baru tidak sama dengan Ulangi Password',
            ];
            $validator = Validator::make($request->all(), $valid, $message);
            if ($validator->fails()) {
                return back()->with('error', 'Ubah password gagal!')->withErrors($validator)->withInput();
            }
            User::where('id', auth()->user()->id)->update([
                'password' => bcrypt($request->passwordbaru)
            ]);
            return back()->with('sukses', 'Password di edit!');
        } elseif ($jenis === 'profile') {
            $valid = [
                'nama' => 'required|max:255',
                'username' => 'required|max:255',
                'gambar' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg'
            ];
            $message = [
                'nama.required' => 'Nama wajib di isi.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'username.required' => 'Username wajib di isi.',
                'username.max' => 'Username maksimal 255 karakter.',
                'gambar.image' => 'File yang di upload bukan gambar.',
                'gambar.file' => 'File yang di upload bukan gambar.',
                'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
                'gambar.mimes' => 'Ekstensi gambar yang di izinkan adalah jpeg, png, jpg, gif, svg.',
            ];

            if ($request->username !== $user->username) {
                $valid['username'] = 'required|max:255|unique:users';
                $message['username.unique'] = 'Username sudah terdaftar.';
            }

            $validator = Validator::make($request->all(), $valid, $message);

            if ($validator->fails()) {
                return back()->with('error', 'Ubah profile gagal!')->withErrors($validator)->withInput();
            }

            $datauser = [
                'name' => $request->nama,
                'username' => $request->username,
            ];
            $dataprofile = [
                'telegram' => $request->telegram,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
            ];
            if ($request->file('gambar')) {
                if ($user->image != 'user.png') {
                    try {
                        Storage::delete($user->image);
                        $datauser['image'] = $request->file('gambar')->store('gambar-user');
                    } catch (\Throwable $th) {
                        return back()->with('error', 'Gagal edit profile! <br> ' . 'Gagal Hapus Foto Lama');
                    }
                } else {
                    try {
                        $datauser['image'] = $request->file('foto')->store('gambar-user');
                    } catch (\Throwable $th) {
                        return back()->with('error', 'Gagal edit profile! <br> ' . 'Gagal Upload foto');
                    }
                }
            }
            User::where('id', auth()->user()->id)->update($datauser);
            Profile::where('uid', auth()->user()->id)->update($dataprofile);

            return back()->with('sukses', 'Profile di edit!');
        } else {
            return back()->with('error', 'Perintah tidak dikenali!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        return redirect()->to(url());
    }
}
