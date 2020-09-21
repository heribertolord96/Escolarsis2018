<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable =[
        'idcurso','nombre','apaterno','amaterno','num_alumno','birthday','num_ide','direccion',
        'telefono','email','sexo','edad','condicion'];
        /* Route Model Binding */public function getRouteKeyName(){
            return 'id';//El nombre de la columna
        }
  
    public function grupo(){
        return $this->belongsTo('App\Grupo');
    }
       
}
