<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'gid', 'id');
    }

}
