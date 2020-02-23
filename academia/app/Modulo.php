<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable=["nombre", "horas"];

    //Métodos para la relación n:m con Alumnos

    public function alumnos(){
        return $this->belongsToMany("App\Alumno")->withPivot("nota")->withTimestamps();
    }
    public function scopeNombre($query, $v){
        return $query->where("nombre", "like", "%$v%");
    }
}
