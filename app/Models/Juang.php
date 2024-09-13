<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juang extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = ['tanggal', 'kategori', 'jumlah', 'keterangan', 'bodoa'];
}


