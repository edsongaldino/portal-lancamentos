<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Estado;
use App\Http\Controllers\Controller;

class CidadeController extends Controller
{

    public function buscarCidade(Request $request)
    {
        $cidades = $this->getCidades($request);
    	return view('backpack::crud.partials.cidades', compact('cidades'));
    }

    public function buscarCidadeStand(Request $request)
    {
        $cidades = $this->getCidades($request);
    	return view('backpack::crud.partials.cidadesStand', compact('cidades'));
    }

    public function buscarCidade2(Request $request)
    {
        $cidades = Cidade::where('estado_id', $request->estado_id)->get();
        return view('backpack::crud.partials.cidades2', compact('cidades'));
    }

    public function buscarCidadePerfil(Request $request)
    {
        $cidades = $this->getCidades($request);
        return view('admin.perfil_construtora.desktop.cidades', compact('cidades'));
    }

    private function getCidades($request)
    {
        $estado_id = $request->input('estado_id');

        $cidades = [[
            'id' => null,
            'nome' => 'Seleciona o estado'
        ]];

        if ($estado_id != 'Selecione o estado') {
            $cidades = Estado::find($estado_id)->cidades->toArray();
        }

        return $cidades;
    }

    public function buscarBairro(Request $request)
    {
        $bairros = $this->getBairros($request);
    	return view('backpack::crud.partials.bairros', compact('bairros'));
    }

    public function buscarBairroComercial(Request $request)
    {
        $bairros = $this->getBairros($request);
        return view('backpack::crud.partials.bairros_comerciais', compact('bairros'));
    }

    public function buscarBairroPerfil(Request $request)
    {
        $bairros = $this->getBairros($request);
        return view('admin.perfil_construtora.desktop.bairros', compact('bairros'));
    }

    private function getBairros($request)
    {
        $cidade_id = $request->input('cidade_id');

        $bairros = [[
            'id' => null,
            'nome' => 'Seleciona uma cidade'
        ]];

        if ($cidade_id) {
            $bairros = Cidade::find($cidade_id)->bairros->toArray();
        }

        return $bairros;
    }

    public function getCidadesHtml($cidades)
    {
        return view('backpack::crud.partials.cidades3', compact('cidades'))->render();
    }

    public function getBairrosHtml($bairros, $bairro_comercial = false)
    {
        return view('backpack::crud.partials.bairros2', compact('bairros', 'bairro_comercial'))->render();
    }

    public function getEstadosHtml($estados)
    {
        return view('backpack::crud.partials.estados', compact('estados'))->render();
    }
}
