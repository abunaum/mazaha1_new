<?php

namespace App\Http\Controllers;

use App\Models\gs;
use App\Models\Profile;
use App\Traits\ImageTrait;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AdminFunction extends Controller
{
    use ImageTrait;

    public function tambah_gs(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jabatan' => 'required',
        ];

        if ($request->email !== null) {
            $rules['email'] = 'required|email:rfc,dns|unique:profiles,email';
        }
        if ($request->file('foto')) {
            $rules['foto'] = 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with('error', 'Tambah data gagal!')->withErrors($validator)->withInput();
        }

        $gs = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'bidang_studi' => $request->bidang_studi,
            'no_hp' => $request->nohp,
        ];
        $creategs = gs::create($gs);
        $gid = $creategs->id;
        $profile = [
            'gid' => $gid,
            'email' => $request->email,
            'telegram' => $request->telegram,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ];
        if ($request->file('foto')) {
            $createimage = $this->imageCreate($request->file('foto'), 'gambar-gs');
            if ($createimage) {
                $profile['image'] = $createimage;
            } else {
                return back()->with('error', 'Guru / Staff gagal di tambah! <br> ' . 'Gagal Upload foto');
            }
        } else {
            $profile['image'] = 'gambar-gs/default.png';
        }
        Profile::create($profile);

        return back()->with('sukses', 'Tambah data berhasil!');
    }

    public function edit_gs(Request $request, $id)
    {
        $person = gs::with('profile')
            ->where('id', $id)
            ->first();

        $rules = [
            'nama' => 'required',
            'jabatan' => 'required',
        ];

        if ($person->profile->email == $request->email) {
            $rules['email'] = 'required|email:rfc,dns';
        } else {
            $rules['email'] = 'required|email:rfc,dns|unique:profiles,email';
        }

        if ($request->file('foto')) {
            $rules['foto'] = 'image|file|max:2048|mimes:jpeg,png,jpg,gif,svg';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with('error', 'Edit data gagal!')->withErrors($validator)->withInput();
        }

        $gs = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'bidang_studi' => $request->bidang_studi,
            'no_hp' => $request->nohp,
        ];
        gs::where('id', $id)->update($gs);
        $profile = [
            'email' => $request->email,
            'telegram' => $request->telegram,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ];
        $fotoori = $person->profile->image;

        if ($request->file('foto')) {
            $cekgambar = $this->imageCheck('gambar-gs/default.png', $request->file('foto'), $fotoori, 'gambar-gs');
            if ($cekgambar === false) {
                return back()->with('error', 'Guru / Staff gagal diedit! <br> ' . 'Gagal Upload gambar');
            } else {
                $profile['image'] = $cekgambar;
            }
        }

        profile::where('id', $person->profile->id)->update($profile);
        return back()->with('sukses', 'Edit data berhasil!');
    }

    public function hapus_gs(Request $request, $id): RedirectResponse
    {
        $gs = gs::with('profile')
            ->where('id', $id)
            ->first();
        Storage::delete($gs->profile->image);
        $gs->delete();
        return back()->with('sukses', 'Hapus data berhasil!');
    }

    public function backup_gs(): Response|Application|ResponseFactory
    {
        $gs = gs::with('profile')
            ->get();
        $fixgs = ['datags' => $gs];
        $jsongs = json_encode($fixgs);
        $jsongs = Crypt::encrypt($jsongs);
        return response($jsongs, 200, [
            'Content-Disposition' => 'attachment; filename="guru&staff-' . time() . '.mazaha"'
        ]);
    }

    public function restore_gs(Request $request)
    {
        $valid = [
            'filejson' => 'required|file|max:2048000',
        ];
        $message = [
            'filejson.required' => 'File restore wajib ada.',
            'filejson.file' => 'File yang di upload bukan file yang benar.',
            'filejson.max' => 'Ukuran File maksimal 2 GB.',
        ];
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return back()->with('error', 'Restore post gagal!')->withErrors($validator)->withInput();
        }
        $data = file_get_contents($request->filejson);
        $data = Crypt::decrypt($data);
        $arrdata = json_decode($data, true);

        $getdata = $arrdata['datags'] ?? null;
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('profiles')->truncate();
        DB::table('gs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        if ($getdata) {
            foreach ($getdata as $dp) {
                try {
                    $datags = [
                        'nama' => $dp['nama'],
                        'alamat' => $dp['alamat'],
                        'jabatan' => $dp['jabatan'],
                        'bidang_studi' => $dp['bidang_studi'],
                        'no_hp' => $dp['no_hp'],
                    ];
                    $creategs = gs::create($datags);
                    $profile = [
                        'gid' => $creategs->id,
                        'email' => null,
                        'telegram' => null,
                        'instagram' => null,
                        'facebook' => null,
                    ];
                    Profile::create($profile);
                } catch (\Exception $e) {
                    return back()->with('error', 'Restore Guru dan Staff gagal! <br> File backup corrupt');
                }
            }
        } else {
            return back()->with('error', 'Restore Guru dan Staff gagal! <br> File backup tidak sesuai');
        }
        return back()->with('sukses', 'Restore Guru dan Staff berhasil!');
    }
}
