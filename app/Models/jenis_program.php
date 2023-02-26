<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_program extends Model
{
    use HasFactory;
    protected $table = 'jenis_program';
    protected $guarded = ['id'];
}
