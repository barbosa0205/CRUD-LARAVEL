<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $campos =[
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];

        //validando que lo que se envia se valide y se mueste si hay errores los mensajes
        $this->validate($request, $campos,$mensaje);

        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        //si hay fotografia cambiamos el input foto para insertarlo en public/uploads
        if($request->hasFile('foto')){
            $datosEmpleado['foto']=$request->file('foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);

        // return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje', 'Empleado Agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit',compact('empleado'))->with('mensaje', 'Empleado Editado con exito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //

        $campos =[
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',

        ];

        if($request->hasFile('foto')){
           $campos=['foto'=>'reqired|max:10000|mimes:jpeg,png'];
           $mensaje=['foto.reqired'=>'La foto es requerida'];
        }

        //validando que lo que se envia se valide y se mueste si hay errores los mensajes
        $this->validate($request, $campos,$mensaje);

        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);

            $datosEmpleado['foto']=$request->file('foto')->store('uploads', 'public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);
        // return view('empleado.edit',compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Empleado Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }


        return redirect('empleado')->with('mensaje', 'Empleado Eliminado con exito');
    }
}
