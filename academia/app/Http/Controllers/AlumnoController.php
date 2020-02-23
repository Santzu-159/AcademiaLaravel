<?php

namespace App\Http\Controllers;

use App\Modulo;
use App\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $modulos = Modulo::all();
        $alumnos = Alumno::orderBy("apellidos")
        ->modulo($request->modulos)
        ->paginate(4);
        return view("alumnos.index",
        compact("alumnos","modulos","request"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {
        $datos=$request->validated();

        //cojo los datos porque voy a modificar el request voy a poner nom y ape la primera letra en mayusculas
        $alumno = new Alumno;
        $alumno->nombre = $datos['nombre'];
        $alumno->apellidos = ucwords(($datos['apellidos']));
        $alumno->mail = $datos['mail'];

        //comprobamos si hemos subido un logo
        if (isset($datos['logo'])) {

            $file = $datos['logo'];
            $nom = 'logo/' . time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->put($nom, \File::get($file));
            $alumno->logo = "img/$nom";

        }
        $alumno->save();
        return redirect()
        ->route('alumnos.index')
        ->with('mensaje', 'Alumno creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view("alumnos.detalle", compact("alumno"));
    }
    public function fmatricula(Alumno $alumno){
        $modulos2=$alumno->modulosOut();
        //compruebo si ya los tiene todos
        if($modulos2->count()==0){
            return redirect()
            ->route("alumnos.show", $alumno)
            ->with("mensaje", "Este alumno ya esta matriculado en todos los modulos");
        }
        //Cargamos el formulario matricular alumno le mando el alumno y los modulos que le fatan
        return view("alumnos.fmatricula", compact("alumno", "modulos2"));
    }
    public function matricular(Request $request){
        $id = $request->alumno_id;
        //me traigo el alumno de codigo id
        $alumno=Alumno::find($id);
        if(isset($request->modulo_id)){
            foreach($request->modulo_id as $item){
                $alumno->modulos()->attach($item);
            }
            return redirect()->route("alumnos.show", $alumno)->with("mensaje", "Alumno Matriculado");
        }
        return redirect()->route("alumnos.show", $alumno)->with("mensaje", "Ningun modulo seleccionado");
    }
    //-----------------------------------------------------------
    public function fcalificar(Alumno $alumno){
        $modulos=$alumno->modulos()->get();
        if($modulos->count()==0){
            return redirect()->route("alumnos.show", $alumno)->with("mensaje", "El alumno no cursa ningun modulo.");
        }
        return view("alumnos.fcalificar", compact("alumno"));
    }
    public function calificar(Request $request){
        // dd($request->modulos);
        $alumno=Alumno::find($request->id_al);
        //recorro el array asociativo con los id modulos y las notas
        foreach($request->modulos as $k=>$v){
            $alumno->modulos()->updateExistingPivot($key, ['nota'=>$k]);
        }
        return redirect()->route('alumnos.show',$alumno)->with("mensaje","Calificaciones Guardadas");
    }  
    //-----------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit',compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //validaciones genericas
        $request->validate([
            'nombre'=>['required'],            
            'apellidos'=>['required'],            
            'mail'=>['required', 'unique:alumnos,mail,'.$alumno->id]    
        ]);
        $alumno->nombre=ucwords($request->nombre);
        $alumno->apellidos=ucwords($request->apellidos);
        $alumno->mail=$request->mail;
        //comprobamos si hemos subido un logo
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $file=$request->file('logo');
            $nom='logo/'.time().'_'.$file->getClientOriginalName();
            //Guardamos el fichero en public
            Storage::disk('public')->put($nom, \File::get($file));
            //si no es la imagen default.jpg borro la imagen antigua
            $imagenOld=$alumno->logo;
            if(basename($imagenOld)!='default.jpg'){
                unlink($imagenOld);
            }
            $alumno->logo="img/$nom";            
        }
        //actualizamos el alumno
        $alumno->update();

        return redirect()->route('alumnos.index')->with("mensaje","Alumno Modificado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //tener cuidado de borrar las imágenes salvo default.jpg
        $logo=$alumno->logo;
        if(basename($logo)!="default.jpg"){ //basename quita la url y se queda solo con el nombre
            unlink($logo);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje','Alumno Borrado.');
    }
}
