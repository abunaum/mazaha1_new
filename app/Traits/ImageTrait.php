<?php

namespace app\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function imageCheck($defaultgambar, $gambarbaru, $gambarlama, $lokasi)
    {
        if ($gambarlama !== $defaultgambar) {
            try {
                Storage::delete($gambarlama);
                return $gambarbaru->store($lokasi);
            } catch (\Throwable $th) {
                return false;
            }
        } else {
            try {
                return $gambarbaru->store($lokasi);
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    public function imageCreate($gambarbaru, $lokasi)
    {
        try {
            return $gambarbaru->store($lokasi);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
