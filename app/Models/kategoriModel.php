<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriModel extends Model
{
    use HasFactory;
    protected $table='kategori';
    protected $fillable = [
      'nama_kategori',
      'tipe_kategori',
  ];

  // Relasi jika ingin menghubungkan ke Dakwah
  public function dakwah()
  {
      return $this->hasMany(dakwahModel::class, 'id_kategori');
  }

  // Relasi jika ingin menghubungkan ke Galeri
  public function galeri()
  {
      return $this->hasMany(galeriModel::class, 'id_kategori');
  }
}
