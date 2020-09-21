<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $fillable =[
        'idcurso','idalumno','idmateria','calificacion','asistencia','conducta','periodo','fecha','condicion'];
    public function cursos()
    {
        return $this->belongsTo('App\Alumno');
    }
    public function personas()
    {
        return $this->belongsTo('App\Materia');
    }
}
