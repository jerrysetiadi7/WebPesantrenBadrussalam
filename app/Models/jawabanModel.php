<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawabanModel extends Model
{
    use HasFactory;
    protected $table='jawaban';
    protected $fillable = [
        'pertanyaan_id',   // isi pertanyaan
        'jawaban',
    ];
    
    public function pertanyaan()
{
    return $this->belongsTo(pertanyaanModel::class, 'pertanyaan_id');
}

public function kyai()
{
    return $this->belongsTo(User::class, 'kyai_id');
}

}
