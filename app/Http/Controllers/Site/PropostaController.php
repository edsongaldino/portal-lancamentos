<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\Models\Empreendimento;
use App\Models\Cliente;
use App\Models\Garagem;
use App\Models\Proposta;
use App\Models\PropostaVaga;
use App\Models\TabelaVendas;

class PropostaController extends Controller
{
    public function GravarDadosCliente(Request $request){

        $unidade = Unidade::find($request->unidade_id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        $this->data['cliente'] = (new Cliente())->salvar($request);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();
        return view('site.empreendimento.premium.mobile.proposta.index', $this->data);

    }

    public function GravarDadosProposta(Request $request){

        $unidade = Unidade::find($request->unidade_id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        $this->data['proposta'] = (new Proposta())->SalvarProposta($request);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        $request->session()->put('proposta', $this->data['proposta']);

        if($this->data['empreendimento']->tipo == 'Vertical'){

            $this->data['garagens'] =  Garagem::where('unidade_id', $request->unidade_id)->where('formato_vaga', 'Extra')->get();

            $this->data['vagas'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->get();
            $this->data['vagas_extras'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->where('formato_vaga', 'Extra')->where('situacao', 'Disponível')->get();
            return view('site.empreendimento.premium.mobile.proposta.selecionar_vaga', $this->data);
        }else{
            return view('site.empreendimento.premium.mobile.proposta.conferir', $this->data);
        }

    }

    public function GravarVagaProposta(Request $request){


        $proposta = Proposta::find($request->id);
        $unidade = Unidade::find($proposta->unidade_id);

        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        $propostaVaga = PropostaVaga::where('proposta_id', $request->id)->where('garagem_id', $request->idVaga)->first();

        if(isset($propostaVaga->id) || isset($unidade->garagem->id)){
            $this->data['vagaExiste'] = 'Sim';
        }else{
            $this->data['vaga'] = (new PropostaVaga())->salvarVaga($request, $proposta);
        }

        $this->data['proposta'] = $proposta;
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['vagas_extras'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->where('formato_vaga', 'Extra')->where('situacao', 'Disponível')->get();

        $garagem = Garagem::where('proposta_vaga.proposta_id', $proposta->id)->join('proposta_vaga', 'garagens.id', '=', 'proposta_vaga.garagem_id')->select('garagens.*')->get();
        $this->data['garagens'] = $garagem;
        $this->data['vagas'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->get();
        $this->data['vagas_extras'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->where('formato_vaga', 'Extra')->where('situacao', 'Disponível')->get();


        return view('site.empreendimento.premium.mobile.proposta.selecionar_vaga', $this->data);

    }

    public function RemoverVagaProposta(Request $request){

        $VagaExcluir = PropostaVaga::where('garagem_id', $request->vaga_id)->where('proposta_id', $request->proposta_id);
        $VagaExcluir->delete();

        $proposta = Proposta::find($request->proposta_id);
        $this->data['proposta'] = $proposta;
        $this->data['unidade'] = Unidade::find($proposta->unidade_id);
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $proposta->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        $garagem = Garagem::where('proposta_vaga.proposta_id', $proposta->id)->join('proposta_vaga', 'garagens.id', '=', 'proposta_vaga.garagem_id')->select('garagens.*')->get();
        $this->data['garagens'] = $garagem;
        $this->data['vagas'] = Garagem::where('empreendimento_id', $proposta->empreendimento_id)->get();
        $this->data['vagas_extras'] = Garagem::where('empreendimento_id', $proposta->empreendimento_id)->where('formato_vaga', 'Extra')->where('situacao', 'Disponível')->get();

        return view('site.empreendimento.premium.mobile.proposta.selecionar_vaga', $this->data);


    }

    public function GravarVagaExtra(Request $request){

        $proposta = Proposta::find($request->id);
        $this->data['proposta'] = $proposta;

        $unidade = Unidade::find($proposta->unidade_id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        (new Proposta())->VagaExtra($request);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        $request->session()->put('proposta', $this->data['proposta']);
        return view('site.empreendimento.premium.mobile.proposta.conferir', $this->data);


    }

    public function ConferirProposta($id){

        $proposta = Proposta::find($id);
        $this->data['unidade'] = $proposta->unidade;
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['proposta'] = $proposta;
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $proposta->empreendimento_id)->where('tipo_tabela_id', 1)->first();
        return view('site.empreendimento.premium.mobile.proposta.conferir', $this->data);


    }

    public function BuscarVaga(Request $request){

        $proposta = Proposta::find($request->id);
        $this->data['proposta'] = $proposta;
        $this->data['unidade'] = Unidade::find($proposta->unidade_id);
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $proposta->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        $garagem = Garagem::where('unidade_id', $proposta->unidade_id)->get();
        $this->data['garagens'] = $garagem;

        if($request->vaga <> ''){
            $this->data['vagas'] = Garagem::where('nome', 'like', '%'.$request->vaga.'%')->where('empreendimento_id', $proposta->empreendimento_id)->get();
        }else{
            $this->data['vagas'] = Garagem::where('empreendimento_id', $proposta->empreendimento_id)->get();
        }

        return view('site.empreendimento.premium.mobile.proposta.selecionar_vaga', $this->data);

    }

    public function AtualizarDadosProposta(Request $request){

        $unidade = Unidade::find($request->unidade_id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        $this->data['proposta'] = (new Proposta())->AtualizarProposta($request);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();


        $this->data['garagens'] =  Garagem::where('unidade_id', $request->unidade_id)->where('formato_vaga', 'Extra')->get();

        $this->data['vagas'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->get();
        $this->data['vagas_extras'] = Garagem::where('empreendimento_id', $unidade->empreendimento_id)->where('formato_vaga', 'Extra')->where('situacao', 'Disponível')->get();
        return view('site.empreendimento.premium.mobile.proposta.selecionar_vaga', $this->data);

        //return view('site.empreendimento.premium.mobile.proposta.conferir', $this->data);

    }

    public function EnviarProposta(Request $request){
        $proposta = Proposta::find($request->proposta_id);
        $this->data['proposta'] = $proposta;
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $proposta->empreendimento_id)->where('tipo_tabela_id', 1)->first();
        (new Proposta())->AtualizaPreferencias($request);

        if(env('APP_ENV') <> 'local'){
            (new Proposta())->enviarEmails($proposta);
        }

        return view('site.empreendimento.premium.mobile.proposta.finalizar', $this->data);
    }

    public function EditarProposta($id){
        $proposta = Proposta::find($id);
        $this->data['unidade'] = Unidade::find($proposta->unidade_id);
        $this->data['cliente'] = Cliente::find($proposta->cliente_id);
        $this->data['proposta'] = $proposta;
        $this->data['empreendimento'] = Empreendimento::find($proposta->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $proposta->empreendimento_id)->where('tipo_tabela_id', 1)->first();
        return view('site.empreendimento.premium.mobile.proposta.index', $this->data);
    }


    public function layoutProposta($id){
        $this->data['proposta'] = Proposta::find($id);
        return view('emails.empreendimento.proposta', $this->data);
    }

}
