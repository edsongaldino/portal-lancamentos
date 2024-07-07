<?php

namespace App\Http\Controllers\Corretor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empreendimento;
use App\Models\Unidade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function sobre(){
        return view('sobre');
    }

    public function politica(){
        return view('politica');
    }

    public function cadastro(){
        return view('corretor.cadastro');
    }

    public function sair(){
        return view('login');
    }

    public function login(){
        return view('corretor.login');
    }

    public function validarLogin(){
        return view('home');
    }

    public function avaliarEmpresa(){
        return view('avaliar-empresa');
    }

    public function Leads(){
        return view('corretor.leads.lista');
    }

    public function ListaPropostas(){
        return view('corretor.propostas.lista');
    }

    public function Proposta(){
        return view('corretor.propostas.proposta');
    }

    public function ListaEmpreendimentos(){
        if(Auth::guard("corretor")->check() === false){
            return view('corretor.login');
        }
        $empreendimentos = Empreendimento::where('status','Liberada')->orderBy('id', 'desc')->take(10)->get();
        $ocultarLinks = "Sim";
        $cidade_id = 0;
        $subtipo_id = 0;
        return view('corretor.empreendimentos.lista')->with(compact('empreendimentos', 'ocultarLinks', 'cidade_id', 'subtipo_id'));
    }

    public function BuscarEmpreendimentos($cidade_id, $subtipo_id){
        if(Auth::guard("corretor")->check() === false){
            return view('corretor.login');
        }

        $BuscaEmpreendimentos = Empreendimento::select("empreendimentos.*")->where('status','Liberada');

        if($cidade_id <> 0){
            $BuscaEmpreendimentos->join('enderecos', 'enderecos.id', '=', 'empreendimentos.endereco_id')->where('enderecos.cidade_id', $cidade_id);
        }
		
		if($subtipo_id <> 0){
            $BuscaEmpreendimentos->where('empreendimentos.subtipo_id', $subtipo_id);
        }
		
        $empreendimentos = $BuscaEmpreendimentos->orderBy('empreendimentos.id', 'desc')->get();
        $ocultarLinks = "Sim";
        return view('corretor.empreendimentos.lista')->with(compact('empreendimentos', 'ocultarLinks', 'cidade_id', 'subtipo_id'));
    }

    public function EmpreendimentoDetalhes($id){
        if(Auth::guard("corretor")->check() === false){
            return view('corretor.login');
        }
        $empreendimento = Empreendimento::find($id);
        $unidade = Unidade::where('empreendimento_id', $id)->where('situacao','Disponível')->get();
        $viewCorretor = 'Corretor';
        return view('site.empreendimento.premium.index', compact('empreendimento', 'unidade', 'viewCorretor'));
    }

    public function Perfil()
    {
        if(Auth::guard("corretor")->check() === false){
            return view('corretor.login');
        }
        $usuario = Auth::guard("corretor")->user();
        return view('corretor.perfil')->with(compact('usuario'));
    }




}
