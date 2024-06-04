<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservaUnidade;
use App\Models\Unidade;

class CronController extends Controller
{
    public function BaixaReserva()
    {

        $unidades = ReservaUnidade::whereDate('data_final_reserva', '<', now()->format('Y-m-d'))->get();
        foreach($unidades as $unidade){

            if($unidade->unidade->situacao == 'Reservada'){

                $reserva = ReservaUnidade::findOrFail($unidade->id);
                $reserva->delete();
    
                $und = Unidade::findOrFail($unidade->unidade_id);
                $und->situacao = 'Disponível';
                $und->save();

                echo $unidade->data_final_reserva.' Atualizada <br/>';

            }            

        }
    	
    }
}
