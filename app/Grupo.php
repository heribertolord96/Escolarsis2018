<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable =[
        'idcategoria','nombre','descripcion','condicion'];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
