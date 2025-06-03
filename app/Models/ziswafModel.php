<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ziswafModel extends Model
{
    use HasFactory;
     protected $tabel='ziswaf';
    protected $fillable=[ 'nama', 'jenis', 'jumlah', 'metode', 'status', 'bukti_transfer'];
    protected $timestamp=true;

}
