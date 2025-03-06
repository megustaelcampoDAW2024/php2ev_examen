<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateCompleteRequest;
use App\Models\Cliente;
use App\Models\Provincia;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class TareaController extends Controller
{
    /**
     * TareaController constructor.
     */
    public function __construct()
    {
        $this->middleware('rol:A')->only('store', 'edit', 'update', 'destroy');
        $this->middleware('rol:O')->only('complete', 'completeUpdate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->rol === 'A') {
            $tareas = Tarea::getAllTareas();
        } else {
            /// return to_route('no.permisos');
            $tareas = Tarea::getTareasByOperario($user->id);
        }
        return view('tarea.index', 
            ['tareas' => $tareas]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()) {
            $clientes = Cliente::all();
            $provincias = Provincia::all();
            return view('tarea.request', [
                'clientes' => $clientes,
                'provincias' => $provincias
            ]);
        }elseif(Auth::user()->rol === 'A') {
            $operarios = User::getOperarios();
            $clientes = Cliente::all();
            $provincias = Provincia::all();
            return view('tarea.create', [
                'operarios' => $operarios,
                'clientes' => $clientes,
                'provincias' => $provincias
            ]);
        }else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTareaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTareaRequest $request)
    {
        // Guarda la tarea primero para obtener su ID
        $tarea = new Tarea($request->validated());
        $tarea->save();
    
        // Usa el ID de la tarea para crear carpetas únicas
        $tareaId = $tarea->id;
    
        if ($request->hasFile('fichero')) {
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_$tareaId", 'public');
            $tarea->fichero = $ficheroPath;
        }
    
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store("fotos/tarea_$tareaId", 'public');
            $tarea->foto = $fotoPath;
        }
    
        // Guarda la tarea nuevamente con las rutas de los archivos
        $tarea->save();
    
        return to_route('tarea.index')->with('status', 'Tarea creada correctamente');
    }

    /**
     * Store a newly created resource request in storage.
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRequest(StoreRequest $request)
    {
        $validatedData = $request->except(['cif', 'telefono']);
        $tarea = new Tarea($validatedData);
        $tarea['estado'] = 'B';
        $tarea['operario_id'] = null;
        $cliente = Cliente::where('cif', $request->cif)
              ->where('telefono', $request->telefono)
              ->first();
        $tarea['cliente_id'] = $cliente->id;
        $tarea->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return view('tarea.show', [
            'tarea' => $tarea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $operarios = User::getOperarios();
        $clientes = Cliente::all();
        $provincias = Provincia::all();
        return view('tarea.edit', [
            'tarea' => $tarea,
            'operarios' => $operarios,
            'clientes' => $clientes,
            'provincias' => $provincias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTareaRequest  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTareaRequest $request, Tarea $tarea)
    {
        $tareaValidada = $request->validated();

        // Eliminar fichero anterior si existe y se ha subido uno nuevo
        if ($request->hasFile('fichero')) {
            if ($tarea->fichero) {
                unlink(storage_path('app/public/' . $tarea->fichero));
            }
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_{$tarea->id}", 'public');
            $tareaValidada['fichero'] = $ficheroPath;
        }

        // Eliminar foto anterior si existe y se ha subido una nueva
        if ($request->hasFile('foto')) {
            if ($tarea->foto) {
                unlink(storage_path('app/public/' . $tarea->foto));
            }
            $fotoPath = $request->file('foto')->store("fotos/tarea_{$tarea->id}", 'public');
            $tareaValidada['foto'] = $fotoPath;
        }

        $tarea->update($tareaValidada);
        
        return to_route('tarea.show', ['tarea' => $tarea])->with('status', 'Tarea actualizada correctamente');
        // return "Estado: '" . $tarea->estado . "'" . "Fecha de realización: '" . $tarea->fecha_realizacion . "'";
    }

    /**
     * Show the form for completing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function complete(Tarea $tarea)
    {
        $user = Auth::user();
        if ($tarea->operario_id === $user->id) {
            $operarios = User::getOperarios();
            $clientes = Cliente::all();
            $provincias = Provincia::all();
            return view('tarea.edit', [
            'tarea' => $tarea,
            'operarios' => $operarios,
            'clientes' => $clientes,
            'provincias' => $provincias
            ]);
        } else {
            return to_route('tarea.index')->with('status', 'No puedes completar una tarea que no te ha sido asignada');
        }
    }

    /**
     * Update the specified resource as completed.
     *
     * @param  \App\Http\Requests\UpdateCompleteRequest  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function completeUpdate(UpdateCompleteRequest $request, Tarea $tarea)
    {
        $tareaValidada = $request->validated();
        $tareaValidada['estado'] = 'R';

        // Eliminar fichero anterior si existe y se ha subido uno nuevo
        if ($request->hasFile('fichero')) {
            if ($tarea->fichero) {
                unlink(storage_path('app/public/' . $tarea->fichero));
            }
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_{$tarea->id}", 'public');
            $tareaValidada['fichero'] = $ficheroPath;
        }

        // Eliminar foto anterior si existe y se ha subido una nueva
        if ($request->hasFile('foto')) {
            if ($tarea->foto) {
                unlink(storage_path('app/public/' . $tarea->foto));
            }
            $fotoPath = $request->file('foto')->store("fotos/tarea_{$tarea->id}", 'public');
            $tareaValidada['foto'] = $fotoPath;
        }

        $tarea->update($tareaValidada);
        
        return to_route('tarea.index')->with('status', 'Tarea completada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return to_route('tarea.index')->with('status', 'Tarea eliminada correctamente');
    }
}
