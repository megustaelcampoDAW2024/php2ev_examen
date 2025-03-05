<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuotaRequest;
use App\Models\Cuota;
use App\Models\Cliente;
use App\Models\Remesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\CuotaFacturaMailable;

class CuotaController extends Controller
{
    /**
     * CuotaController constructor.
     */
    public function __construct()
    {
        $this->middleware('rol:A')->only('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupedCuotas = Cuota::getCuotasGroupedByCliente();
        $remesas = Remesa::paginate(10);
        return view('cuota.index', compact('groupedCuotas', 'remesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $remesas = Remesa::all();
        return view('cuota.create', compact('clientes', 'remesas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCuotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCuotaRequest $request)
    {
        $cuotaValidada = $request->validated();
        $remesa = Remesa::find($cuotaValidada['remesa_id']);
        $cliente = Cliente::find($cuotaValidada['cliente_id']);

        if ($cuotaValidada['remesa_id'] == null){
            $cuotaValidada['concepto'] = 'Trabajo Extra';
            $cuotaValidada['fecha_emision'] = now();

        } else {
            $cuotaValidada['importe'] = $cliente->importe_mensual;
            $cuotaValidada['concepto'] = 'Remesa';
            $cuotaValidada['notas'] = 'Remesa ' . $remesa->mes . ' - ' . $remesa->ano;
        }
        $cuotaValidada['moneda'] = $cliente->moneda;

        $cuota = new Cuota($cuotaValidada);
        $cuota->save();

        return to_route('cuota.index')->with('status', 'Cuota creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
        $clientes = Cliente::all();
        $remesas = Remesa::all();
        return view('cuota.edit',compact('cuota', 'clientes', 'remesas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCuotaRequest  $request
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCuotaRequest $request, Cuota $cuota)
    {
        $cuotaValidada = $request->validated();
        $remesa = Remesa::find($cuotaValidada['remesa_id']);
        $cliente = Cliente::find($cuotaValidada['cliente_id']);
        
        if ($cuotaValidada['remesa_id'] == null){
            $cuotaValidada['concepto'] = 'Trabajo Extra';
        } else {
            $cuotaValidada['concepto'] = 'Remesa';
            $cuotaValidada['notas'] = 'Remesa ' . $remesa->mes . ' - ' . $remesa->ano;
        }

        $cuota->update($cuotaValidada);

        return to_route('cuota.index')->with('status', 'Cuota actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        return to_route('cuota.index')->with('status', 'Cuota eliminada correctamente');
    }

    /**
     * Print the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function print(Cuota $cuota)
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/' . $cuota->moneda);
        $exchangeRate = $response->json()['rates']['EUR'];
        $importe_euro = round($cuota->importe * $exchangeRate, 2);
        $pdf = Pdf::loadView('cuota.factura', compact('cuota', 'importe_euro'));
        return $pdf->download('factura_cuota_' . $cuota->id . '.pdf');
    }

    /**
     * Mark the specified resource as paid.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function paid(Cuota $cuota)
    {
        if (is_null($cuota->fecha_pago)) {
            // Fetch exchange rate from a public API
            $response = Http::get('https://api.exchangerate-api.com/v4/latest/' . $cuota->moneda);
            $exchangeRate = $response->json()['rates']['EUR'];

            $cuota->update([
                'fecha_pago' => now(),
                'importe_euro' => $cuota->importe * $exchangeRate,
            ]);
        }
        return to_route('cuota.index')->with('status', 'Cuota marcada como pagada');
    }

    /**
     * Send an email with the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Cuota $cuota)
    {
        Mail::to($cuota->cliente->correo)->send(new CuotaFacturaMailable($cuota));
        return to_route('cuota.index')->with('status', 'Correo enviado correctamente');
    }
    
}