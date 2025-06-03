<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilModel extends Model
{
    use HasFactory;
      protected $tabel='profil';
    protected $fillable=[ 'nama_pesantren', 'visi', 'misi', 'sejarah', 'alamat', 'kontak', 'logo'];
    protected $timestamp=true;

}
