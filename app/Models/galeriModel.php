<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galeriModel extends Model
{
     use HasFactory;
    protected $table='galeri';
    protected $fillable=[ 'judul', 'deskripsi', 'image_url','id_kategori'];
    public $timestamp=true;
    public function kategori()
{
    return $this->belongsTo(kategoriModel::class, 'id_kategori');
}
}
