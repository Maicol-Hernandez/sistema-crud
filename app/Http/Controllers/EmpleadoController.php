<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
// Clase para eliminar fotos del storage
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

        /**
         * Muestra la vista de crate
         * Se consulta a la DB
         */

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
        /**
         * Muestra la vista de crate
         * 
         */

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
        // Insertamos los datos en la DB 

        $campos = [
            'nombre' => 'required|string|max:100 ',
            'primerApellido' => 'required|string|max:100',
            'segundoApellido' => 'required|string|max:100',
            'email' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensage = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida',
        ];

        $this->validate($request, $campos, $mensage);

        $datosEmpleado = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Empleado::insert($datosEmpleado);
        return redirect('empleado')->with('mensaje', '¡Empleado agregado con éxito!');
        // return response()->json($datosEmpleado);
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
    public function edit(Empleado $empleado)
    {
        // Enviamos los datos a la vista de edit

        // echo "empleado edit". $empleado;

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        // 
        $campos = [
            'nombre' => 'required|string|max:100 ',
            'primerApellido' => 'required|string|max:100',
            'segundoApellido' => 'required|string|max:100',
            'email' => 'required|email',
        ];

        $mensage = ['required' => 'El :attribute es requerido',];

        if (request()->hasFile('foto')) {
            $campos = ['foto' => 'required|max:10000|mimes:jpeg,png,jpg',];
            $mensage = ['foto.required' => 'La foto es requerida',];
        }

        $this->validate($request, $campos, $mensage);

        $datos = request()->except(['_token', '_method']);

        if (request()->hasFile('foto')) {
            Storage::delete('public/' . $empleado->foto);
            $datos['foto'] = request()->file('foto')->store('uploads', 'public');
        }
        Empleado::where('id', '=', $empleado->id)->update($datos);
        $empleado = Empleado::findOrFail($empleado['id']);

        // return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', '¡Empleado modificado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        // 
        if (Storage::delete('public/' . $empleado->foto)) {
            Empleado::destroy($empleado['id']);
        }

        return redirect('empleado')->with('mensaje', '¡Empleado borrado con éxito!');
    }
}
