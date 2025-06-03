<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class userModel extends Authenticatable
{
    use Notifiable;
    protected $table='user';
    protected $fillable=[ 'name', 'email', 'password','role',];
    public $timestamps=true;

}
