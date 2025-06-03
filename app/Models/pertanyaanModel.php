<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaanModel extends Model
{
    use HasFactory;
    protected $table='pertanyaan';
    protected $fillable = [
        'name',         // nama penanya
        'pertanyaan',   // isi pertanyaan
 
    ];
    public function jawaban()
{
    return $this->hasOne(jawabanModel::class,'pertanyaan_id','id');
}
    
}
