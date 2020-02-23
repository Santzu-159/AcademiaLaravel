<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modulos = Modulo::orderBy("nombre")
        ->nombre($request->nombre)
        ->paginate(3);

        return view("modulos.index",
        compact("modulos","request"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modulos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre"=>["required"],
            "horas"=>["required"]
        ]);
        Modulo::create($request->all());

        return redirect()
        ->route("modulos.index")
        ->with("mensaje", "Modulo Guardado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        return view("modulos.detalle", compact("modulo"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        return view("modulos.edit", compact("modulo"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            "nombre"=>["required", "unique:modulos,nombre,".$modulo->id],
            "horas"=>["required"]
        ]);
        $modulo->update($request->all());

        return redirect()
        ->route("modulos.index")
        ->with("mensaje", "Modulo Actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()
        ->route("modulos.index")
        ->with("mensaje", "Modulo Borrado.");
    }
}
