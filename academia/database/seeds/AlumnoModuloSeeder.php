<?php

use App\Alumno;
use App\Modulo;
use Illuminate\Database\Seeder;

class AlumnoModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Alumno::all() as $alumno){
            //elijo un número aleatorio entre 0 y el número de módulos totales
            $num=rand(0,Modulo::all()->count());
            for($i=1; $i<$num;$i++){
                //cojo una nota de 0 a 10 con decimales
                $nota=rand(0,9)+(1/rand(1,10));
                $alumno->modulos()->attach($i,['nota'=>$nota]);
            }
        }
    }
}
