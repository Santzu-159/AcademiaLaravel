<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Modulo;

class Alumno extends Model
{
    protected $fillable =["nombre", "apellidos", "mail", "logo"];

    public function modulos(){
    //    return  $this->belongsToMany("App\Modulo")->as("notas")->withPivot("nota")->withTimestamps();
       return $this->belongsToMany("App\Modulo")->withPivot("nota")->withTimestamps();
    }
    public function modulosOut(){
        //Esto me devuelve los id de los modulos que tiene el alumno
        $modulos1=$this->modulos()->pluck("modulos.id");
        //esto me devuelve los modulos que le faltan al alumno
        $modulos2=Modulo::whereNotIn('id', $modulos1)->get();
        return $modulos2;
    }
    public function notaMedia(){
        $suma = 0 ;
        $total = $this->modulos()->wherePivot("nota","!=","null")->count();
        if($total>0){
            foreach($this->modulos as $modulo){
                $nota=$modulo->pivot->nota;
                $suma+=$nota;
            }
            return round($suma/$total, 2);
        }
        return "Sin modulo";
    }
    public static function alumnosAprobados(){
        $alumnos = Alumno::all();
        foreach($alumnos as $alumno){
            if($alumno->notaMedia()>=5){
                $idAlumnos[]=$alumno->id;
            }
        }
        return Alumno::whereIn("id", $idAlumnos)->get();
    }
    public function scopeModulo($query, $v){
        if($v=='%' || $v==null){
            return $query;
        }
        return $query->whereHas("modulos", function ($query) use ($v){
            $query->where("modulos.id", "$v");
        });
    }
}
