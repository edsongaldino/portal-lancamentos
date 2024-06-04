<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Empreendimento;
use App\Models\ResumoEstatistica;
use App\Http\Controllers\Controller;

class EstatisticaController extends Controller
{
    public function atualizaResumo(Request $request)
    {
        $empreendimentos = Empreendimento::limit(10)->inRandomOrder()->get();

        foreach($empreendimentos AS $empreendimento):

            $total_resumo = $empreendimento->resumo_estatistica()->where('tipo', $request->tipo)->where('ano', $request->ano)->where('mes', $request->mes)->get()->first();

            if($total_resumo):

                if($request->mes == '09'):
                    $atualiza = (new ResumoEstatistica)->salvarResumoMes($empreendimento, $request->tipo, $request->mes, $request->ano);
                else:
                    echo "O resumo do empreendimento (".$empreendimento->nome.") já existe";
                endif;
            else:
                $atualiza = (new ResumoEstatistica)->salvarResumoMes($empreendimento, $request->tipo, $request->mes, $request->ano);
            endif;

            if(isset($atualiza)):
                echo "O empreendimento (".$empreendimento->nome.") foi atualizado";
            else:
                echo "O resumo do empreendimento (".$empreendimento->nome.") já existe";
            endif;

        endforeach;
            	
    }

}
