<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subtipo;
use App\Models\Variacao;

class TipoEmpreendimentoController extends Controller
{
    public function buscarSubtipo(Request $request)
    {
        $tipo = $request->tipo;
        $subtipos = Subtipo::where("tipo",$tipo)->get();
    	return view('backpack::crud.partials.subtipos', compact('subtipos'));
    }

    public function buscarVariacao(Request $request)
    {
        $subtipo_id = $request->subtipo;
        $variacoes = Variacao::where("subtipo_id",$subtipo_id)->get();
    	return view('backpack::crud.partials.variacoes', compact('variacoes'));
    }

}
