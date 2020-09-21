<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable =[
        'idcategoria','nombre','descripcion','condicion'];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    
    public function materias()
    {
      return $this->hasMany('App\Materia');
    }
}

