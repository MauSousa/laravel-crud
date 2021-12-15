<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Consultamos info db
        $datos['empleados'] = Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Le damos al controlador la info de la vista
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
        
        $campos = [
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensajeError = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida',
        ];

        $this->validate($request, $campos, $mensajeError);

        // $datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');
        
        // Verificar foto
        if( $request->hasFile('Foto') ) {
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);

        // return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado exitosamente');
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
        // Editamos al empleado
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validamos los campos
        $campos = [
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
        ];

        $mensajeError = [
            'required' => 'El :attribute es requerido',
        ];

        if( $request->hasFile('Foto')) {
            $campos = ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensajeError = ['Foto'=>'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensajeError);

        // Actualizamos los datos
        $datosEmpleado = request()->except(['_token', '_method']);
        
        // Verificar foto
        if( $request->hasFile('Foto') ) {
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public'.$empleado->Foto);
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        Empleado::where('id', '=', $id)->update($datosEmpleado);

        $empleado = Empleado::findOrFail($id);
        // return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje','Empleado modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Borramos la foto del usuario borrado
        $empleado = Empleado::findOrFail($id);

        if( Storage::delete('public/'.$empleado->Foto) ) {
            Empleado::destroy($id);
        }

        // Borramos al empleado
        Empleado::destroy($id);

        // Redireccionamos a la vista de empleados
        return redirect('empleado')->with('mensaje','Empleado borrado exitosamente');
    }
}
