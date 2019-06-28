<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Zakaznik as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Zakaznik extends Authenticatable
{

    use Notifiable;

    protected $table = 'zakaznik';
    protected $primaryKey ='zakaznik_id';
    protected $fillable = ['meno', 'priezvisko', 'login', 'password', 'datum_narodenia',
        'mobil_number','email','datum_registracie', 'adresa_id'];
    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function adresa(){
        return  $this->belongsTo('App\Adresa', 'adresa_id', 'adresa_id');
    }

}
