<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //
    protected $fillable =[
        'idmateria','nump','condicion'];
    public function materias()
    {
        return $this->belongsTo('App\Materia');
    }

    public function sesions()
{
    return $this->belongsTo('App\Sesion');
}
}

