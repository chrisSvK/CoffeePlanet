<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresa extends Model
{
    protected $table = 'adresa';
    protected $primaryKey ='adresa_id';
    protected $fillable = ['adresa_id', 'mesto', 'ulica','psc'];
    public $timestamps = false;

}
