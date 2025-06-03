<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dakwahModel extends Model
{
    use HasFactory;
    protected $table='dakwah';
    protected $fillable=[ 'judul', 'isi', 'video_url', 'id_kategori'];
    public $timestamp=true;
    public function kategori()
{
    return $this->belongsTo(kategoriModel::class, 'id_kategori');
}
}
