<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable =[
        'idgrupo','idcurso'];
    public function curso(){
        return $this->belongsTo('App\Curso');
    }
    public function grupo(){
        return $this->belongsTo('App\Grupo');
    }
    public function matricula(){
        return $this->belongsTo('App\Matricula');
    }
}
