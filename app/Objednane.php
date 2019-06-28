<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objednane extends Model
{
    protected $table = 'objednane';
    protected $primaryKey ='objednane_id';
    protected $fillable = ['objednavka_id', 'produkt_id', 'atribut_id','mnozstvo'];
    public $timestamps = false;

}
