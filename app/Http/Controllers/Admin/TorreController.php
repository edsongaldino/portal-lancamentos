<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Empreendimento;
use App\Models\Torre;
use App\Models\Planta;
use App\Models\Unidade;
use App\Http\Controllers\Controller;

class TorreController extends Controller
{
    public function buscarTorre(Request $request)
    {
        $empreendimento_id = $request->empreendimento_id;

        $torres = Empreendimento::find($empreendimento_id)->torres->toArray();
        
    	return view('backpack::crud.partials.torres', compact('torres'));
    }

    public function buscarTorresQuadrasOferta(Request $request)
    {
        $empreendimento = Empreendimento::find($request->empreendimento_id);

        if ($empreendimento->tipo == 'Vertical') {
            $torres = $empreendimento->getTorresDisponiveis();   
            return view('backpack::crud.partials.torres2', compact('torres')); 
        } else {
            $quadras = $empreendimento->getQuadrasDisponiveis();    
            return view('backpack::crud.partials.quadras', compact('quadras')); 
        }                        
    }

    public function buscarAndares($id)
    {
        $torre = Torre::find($id);

    	$array = $torre->andares;

        $andares = [];

        foreach ($array as $andar) {
            $unidades = $andar->unidades->where('situacao', 'Disponível')->where('status', 'Liberada')->toArray();
            if (count($unidades)) {
                $andares[] = $andar;
            }
        }

    	return view('backpack::crud.partials.andares', compact('andares'));
    }

    public function buscarAndares2($torre_id, $request)
    {
        if ($torre_id != 'Todas') {
            $andares = Torre::find($torre_id)->andares;
        }

        return view('admin.empreendimentos.empreendimento.unidade.andares', compact('andares'));
    }

    public function buscarUnidades($id)
    {
        $unidades = Unidade::select('unidades.*')->where('andar_id', $id)->where('situacao', 'Disponível')->get();

    	return view('backpack::crud.partials.unidades', compact('unidades'));
    }

    public function buscarPlantas($id)
    {
        $unidade = Unidade::find($id);

        if ($unidade->empreendimento->variacao->id == 6 || $unidade->empreendimento->variacao->id == 10 || $unidade->empreendimento->variacao->id == 11) {
            return view('backpack::crud.partials.metragem');
        }

        $planta = $unidade->planta;
        $planta_nome = null;

        if ($planta) {
            $planta_nome = $planta->nome;
        }

        $plantas = Planta::where('empreendimento_id', $unidade->empreendimento->id)->get();
    	return view('backpack::crud.partials.plantas', compact('planta_nome', 'plantas'));
    }

    public function buscarUnidades2(Request $request)
    {
        $unidades = Unidade::where('torre_id', $request->torre_id)->get();

        return view('admin.empreendimentos.desktop.empreendimento.unidade.unidades_ajax', compact('unidades'));
    }

    public function buscarUnidadesVendidas(Request $request)
    {
        $unidades = Unidade::where('torre_id', $request->torre_id)->where('situacao', 'Vendida')->get();

        return view('admin.financeiro.desktop.unidades_vendidas_ajax', compact('unidades'));
    }
}
