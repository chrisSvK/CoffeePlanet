<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    protected $table = 'atribut';
    protected $primaryKey ='atribut_id';
    protected $fillable = ['produkt_id', 'atribut', 'value','cena','pocet'];
    public $timestamps = false;

}
