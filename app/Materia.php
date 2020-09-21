<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable =[
        'idcurso','idpersona','nombre','descripcion','condicion'];
    public function cursos()
    {
        return $this->belongsTo('App\Curso');
    }
    public function personas()
    {
        return $this->belongsTo('App\Persona');
    }
}
