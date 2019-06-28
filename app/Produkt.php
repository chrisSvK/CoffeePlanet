<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    protected $table = 'produkt';
    protected $primaryKey ='produkt_id';
    protected $fillable = ['name', 'kategoria_id', 'popis', 'datum_pridania','pocet_objednani'];
    public $timestamps = false;

    public function kategoria()
    {
        return $this->hasOne('App\Kategoria', 'kategoria_id');

    }

    public function atributy(){
        return  $this->hasMany('App\Atribut', 'produkt_id', 'produkt_id');
    }

    public function galeria(){
        return  $this->hasMany('App\Galeria', 'produkt_id', 'produkt_id' );
    }
}
