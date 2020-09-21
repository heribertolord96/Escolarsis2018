<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $fillable =[
        'idalumno','nombre','fecha','descripcion','condicion'];
    public function cursos()
    {
        return $this->belongsTo('App\Alumno');
    }
}
