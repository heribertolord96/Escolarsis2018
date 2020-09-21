<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable =[
        'idcurso','nombre','descripcion','condicion'];
    public function cursos()
    {
        return $this->belongsTo('App\Curso');
    }
}
