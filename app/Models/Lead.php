<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use App\Mail\Empreendimento\Lead\Construtora as EmailConstrutora;
use App\Mail\Empreendimento\Lead\Cliente as EmailCliente;
use App\Mail\Empreendimento\Lead\Administrador as EmailAdm;
use App\Mail\Empreendimento\Lead\Sugestao as EmailSugestao;
use App\Models\Empreendimento;
use \DB;
use Illuminate\Support\Facades\Request;
use GuzzleHttp\Client;

class Lead extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'leads';


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function contato($request)
    {
        if ($this->jaEnviou($request)) {
            return true;
        }

        DB::beginTransaction();

        $empreendimento = Empreendimento::find($request->empreendimento_id);

        $lead = $this;
        $lead->empreendimento_id = $empreendimento->id;
        $lead->construtora_id = $empreendimento->construtora->id;
        $lead->nome = $request->nome;

        if(isset($request->tipo_clique)){
            $lead->telefone = $request->whatsapp;
            $lead->mensagem = 'Lead gerado através de contato direto por '.$request->tipo_clique;
        }else{
            $lead->telefone = $request->telefone;
            $lead->email = $request->email;
            $lead->previsao = $request->previsao;
            $lead->interesse = $request->interesse;
            $lead->renda = $request->renda;
            $lead->mensagem = $request->mensagem;
        }

        $lead->dispositivo = $this->getDispositivo($request);
        $lead->origem = $this->getOrigemContato($request);
        $lead->tempo = $this->getTempoAcesso($request);
        $lead->save();

        if($request->email == "edsongaldino@outlook.com" || $request->email == "teste@lancamentosonline.com.br"):
            $this->integracoes();
        else:
            if(isset($request->tipo_clique)){
                $this->enviarEmailsConstrutora();
            }else{
                $this->enviarEmails();
            }
        endif;

        DB::commit();

        return true;
    }

    public function jaEnviou($request)
    {
        if($request->whatsapp){
            $leads = Lead::where('nome', $request->nome)->where('telefone', $request->whatsapp)->whereRaw('created_at >= DATE_SUB(NOW(),INTERVAL 10 MINUTE)')->get();
        }else{
            $leads = Lead::where('nome', $request->nome)->where('email', $request->email)->whereRaw('created_at >= DATE_SUB(NOW(),INTERVAL 10 MINUTE)')->get();
        }

        $total = count($leads);

        if ($total && $total > 10) {
            return true;
        }

        $empreendimento = Empreendimento::find($request->empreendimento_id);

        if($request->whatsapp){
            $lead = Lead::where('empreendimento_id', $empreendimento->id)
            ->where('construtora_id', $empreendimento->construtora_id)
            ->where('nome', $request->nome)
            ->where('telefone', $request->whatsapp)
            ->get();
        }else{
            $lead = Lead::where('empreendimento_id', $empreendimento->id)
            ->where('construtora_id', $empreendimento->construtora_id)
            ->where('nome', $request->nome)
            ->where('telefone', $request->telefone)
            ->get();
        }

        if (count($lead)) {
            return true;
        }

        return false;
    }

    public function getOrigemContato($request)
    {
        $portais = [
            "Google",
            "Facebook",
            "Bing",
            "Mitula",
            "Trovit",
            "Youtube",
            "Instagram",
            "Yahoo"
        ];

        $origem_usuario = null;

        $origem = $request->session()->exists('url_origem')
            ? session('url_origem')
            : 'Não identificado';

        foreach ($portais as $portal) {
            if (strpos($origem, strtolower($portal)) !== FALSE) {
                $origem_usuario = $portal;
                break;
            }
        }

        if (!$origem_usuario) {
            $origem_usuario = "Lançamentos Online";
        }

        $request->session()->put('origem', $origem_usuario);

        return $origem_usuario;
    }

    public function getTempoAcesso($request)
    {
        $horario_acesso = $request->session()->get('horario_acesso', date('H:i:s'));
        $acesso = gmdate('H:i:s', abs(strtotime($horario_acesso) - strtotime(date('H:i:s'))));
        $request->session()->put('acesso', $acesso);
        return $acesso;
    }

    public function getDispositivo($request)
    {
        $user_agents = [
            "iPhone",
            "iPad",
            "Android",
            "webOS",
            "BlackBerry",
            "iPod",
            "Symbian",
            "IsGeneric"
        ];

        $modelo = null;

        foreach ($user_agents as $user_agent) {
            if (strpos(Request::server('HTTP_USER_AGENT'), $user_agent) !== false) {
                $modelo = $user_agent;
                break;
            }
        }

        return $modelo ? $modelo : "Desktop";
    }

    public function enviarEmails()
    {

        if($this->construtora->envio_lead == 'Ativo'){

            $this->integracoes();
            $contatos_construtora = $this->construtora->usuarios->toArray();

            if ($contatos_construtora) {
                $destinatarios = array_column($contatos_construtora, 'email');
                Mail::to($destinatarios)->send(new EmailConstrutora($this));
            }

        }else{

            foreach ($this->construtora->parceiros as $parceiro) {
                Mail::to($parceiro->email)->send(new EmailConstrutora($this));
            }

        }

        Mail::to($this->email)->send(new EmailCliente($this));

        
        if (config('app.ambiente') == 'producao') {
            $EmailAdmin = 'contato@lancamentosonline.com.br';
            Mail::to($EmailAdmin)->send(new EmailAdm($this));
        }
        
        
    }

    public function enviarEmailsConstrutora()
    {

        /*Antes os leads eram enviados para todos os usuários da construtora, correção feita em 16/05/2022*/
        if($this->construtora->envio_lead == 'Ativo'){
            $this->integracoes();
            if($this->empreendimento->caracteristicas->where('nome', 'email_lead')->first()){

                foreach (explode(',', $this->empreendimento->caracteristicas->where('nome', 'email_lead')->first()->pivot->valor) as $email) {
                    Mail::to($email)->send(new EmailConstrutora($this));
                }

            }else{
                Mail::to($this->construtora->email)->send(new EmailConstrutora($this));
            }

        }else{

            foreach ($this->construtora->parceiros as $parceiro) {
                Mail::to($parceiro->email)->send(new EmailConstrutora($this));
            }

        }

        /*
        if (config('app.ambiente') == 'producao') {
            $EmailAdmin = 'contato@lancamentosonline.com.br';
            Mail::to($EmailAdmin)->send(new EmailAdm($this));
        }
        */

    }

    public function enviarSugestoes()
    {

        Mail::to($this->email)->send(new EmailSugestao($this));

    }

    public function integracoes()
    {
        //$this->integracaoMrv();
        $this->integracaoFacilita();
        $this->integracaoAnapro();
        $this->integracaoCapys();
    }


    public function integracaoMrv()
    {
        $empreendimento = Empreendimento::find($this->empreendimento_id);
        $client_id = "94EEC703-0C6A-433A-BD63-351AA1EE1DA2";

        if ($empreendimento->construtora_id == 13 && $client_id) {

            $url = "https://cmsapi.mrv.com.br/api/formulario/classificados/cadastrar";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = '{
                        "IdImovel": '.$empreendimento->id.',
                        "NomeDoImovel": "'.$empreendimento->nome.'",
                        "Nome": "'.$this->nome.'",
                        "DDD": "'.$this->getDdd().'",
                        "Telefone": "'.$this->getTelefoneSemDddMrv().'",
                        "Celular": "'.$this->getTelefoneSemDddMrv().'",
                        "Email": "'.$this->email.'",
                        "Texto": "'.$this->getMensagem().'",
                        "DataEnvio": "'.$this->created_at->format('Y-m-d H:i:s').'",
                        "ReceberNovidades": 0,
                        "Origem": "lancamentosonline",
                        "ClientID": "'.$client_id.'",
                        "Dispositivo": "'.$this->getDispositivoMrv().'"
                    }';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

        }

    }

    public function getDispositivoMrv()
    {
        if ($this->dispositivo == 'Desktop') {
            return 'D';
        }

        return 'M';
    }

    public function getDdd()
    {
        if ($this->telefone) {
            return substr($this->telefone, 1, 2);
        }
    }

    public function getTelefoneSemDdd()
    {
        if ($this->telefone) {
            return substr($this->telefone, 5, 14);
        }
    }

    public function getTelefoneSemDddMrv()
    {
        if ($this->telefone) {
            return str_replace('-', '', substr($this->telefone, 5, 14));
        }
    }

    public function getMensagem()
    {
        $mensagem = '';

        if ($this->mensagem) {
            $mensagem .= $this->mensagem . "\n";
        }

        if ($this->previsao) {
            $mensagem .= 'Previsão de compra: ' . $this->previsao . "\n";
        }

        if ($this->interesse) {
            $mensagem .= 'Interesse: ' . $this->interesse . "\n";
        }

        if ($this->renda) {
            $mensagem .= 'Renda: ' . $this->renda . "\n";
        }

        return $mensagem;
    }

    public function integracaoFacilita()
    {
        $empreendimento = Empreendimento::find($this->empreendimento_id);

        if ($empreendimento->construtora_id == 58) {

            $dados = [
                'leadOrigin' => 'Lançamentos Online',
                'timestamp' => $this->created_at->format('Y-m-d H:i:s'),
                'originLeadId' => $this->id,
                'originListingId' => $empreendimento->id,
                'clientListingId' => $this->email,
                'name' => $this->nome,
                'email' => $this->email,
                'ddd' => $this->getDdd(),
                'phone' => $this->getTelefoneSemDdd(),
                'message' => $this->getMensagem()
            ];

            $client = new Client();

            try {
                $request = $client->post('https://grupovivart.api.facilitavendas.com/public/portals/lead', [
                    'json' => $dados
                ]);
            } catch (\Exception $e) {
                // Não faz nada
            }
        }
    }

    public function integracaoCapys()
    {
        $empreendimento = Empreendimento::find($this->empreendimento_id);

        if ($empreendimento->construtora_id == 74) {

            $url = "https://crmapi.capys.com.br/api/apiConta/InsereCasoLead";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $token_bearer = $this->valida_token();

            $headers = array(
            "Accept: application/json",
            "Authorization: Bearer $token_bearer",
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = '{"DS_NOME": "'.$this->nome.'", "DS_EMAIL": "'.$this->email.'", "NR_TELEFONE": "'.$this->telefone.'", "ID_ORIGEM_LEAD": "145", "DS_DESCRICAO_CASO": "'.$this->getMensagem().'",  "FL_WEB_TO_LEAD": true, "DS_EMAIL_RESPONSAVEL": "ubirajara.souto@grupoecher.com.br"}';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

        }

    }

    public function integracaoAnapro()
    {
        if ($this->empreendimento_id == 202 || $this->empreendimento_id == 203) {

            $produtosKey = [
                202 => 'M0vrXVyFm7Y1',
                203 => 'sE79q9NRQd41'
            ];

            $dados = [
                'Key' => 'oNWDMIRApWU1',
                'CampanhaKey' => 'G0e_Ts6hA3c1',
                'ProdutoKey' => '',
                'CanalKey' => $produtosKey[$this->empreendimento_id],
                'Midia' => 'Lançamentos Online',
                'PessoaNome' => $this->nome,
                'PessoaEmail' => $this->email,
                'PessoaTelefones' => [
                    "Tipo" =>  "OUTR",
                    "DDD" => $this->getDdd(),
                    "Numero" => $this->getTelefoneSemDdd(),
                    "Ramal" => null
                ],
                "Observacoes" => $this->getMensagem()
            ];

            $client = new Client();

            try {
                $request = $client->post('http://crm.anapro.com.br/webcrm/webapi/integracao/v2/CadastrarProspect', [
                    'json' => $dados
                ]);
            } catch (\Exception $e) {
                // Não faz nada
            }
        }
    }

    public function valida_token(){

        $url = "https://crmapi.capys.com.br/oauth";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Accept: application/json",
        "Authorization: Bearer {token}",
        "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "grant_type=password&auth_token=uHrpWCB27WNqEM92k6yRfDoJmSYngn5X";

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $json_str = json_decode($resp, true);

        //Sua string:
        $bearer = $json_str["access_token"];

        return $bearer;

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
