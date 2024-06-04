<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Planta;
use App\Models\Unidade;
use App\Http\Controllers\Controller;

class QuadraController extends Controller
{
    public function buscarUnidades($id)
    {
        $unidades = Unidade::where('quadra_id', $id)->where('situacao', 'Disponível')->get();

    	return view('backpack::crud.partials.unidades', compact('unidades'));
    }

    public function buscarUnidades2(Request $request)
    {
        $unidades = Unidade::where('quadra_id', $request->quadra_id)->get();

    	return view('admin.empreendimentos.desktop.empreendimento.unidade.unidades_ajax', compact('unidades'));
    }

    public function buscarUnidadesVendidas(Request $request)
    {
        $unidades = Unidade::where('quadra_id', $request->quadra_id)->where('situacao', 'Vendida')->get();

        return view('admin.financeiro.desktop.unidades_vendidas_ajax', compact('unidades'));
    }
}
