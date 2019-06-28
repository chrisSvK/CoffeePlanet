<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objednavka extends Model
{
    protected $table = 'objednavka';
    protected $primaryKey ='objednavka_id';
    protected $fillable = ['zakaznik_id', 'fakt_adresa_id', 'doruc_adresa_id',
        'payment_method_id', 'delivery_method_id', 'datum_objednavky', 'datum_dorucenia', 'cena'];
    public $timestamps = false;

}
