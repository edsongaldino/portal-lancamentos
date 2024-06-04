<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Construtora;
use App\Models\Empreendimento;
use App\Models\Lead;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\Empreendimento\Lead\Construtora as EmailConstrutora;
use App\Mail\Empreendimento\Lead\Administrador as EmailAdm;

class LeadController extends Controller
{
    private $view;

    public function __construct() {
        $this->view = isMobile() ? 'admin.lead.desktop.index' : 'admin.lead.desktop.index';
    }

    public function index(Request $request)
    {   
        $this->data['leads'] = [];     
        
        $construtora_id = get_construtora_id();        

        if ($construtora_id) {
            $this->data['leads'] = Construtora::find($construtora_id)->leads()->orderBy('created_at', 'DESC')->get();
        }

    	return view($this->view, $this->data);
    }


    public function exportarLeads(Request $request)
    {

        $construtora_id = get_construtora_id();        

        if ($construtora_id) {
            $leads = Construtora::find($construtora_id)
            ->leads()
            ->orderBy('created_at', 'DESC')
            ->groupBy('email','created_at')
            ->get();
            
            //declaramos uma variavel para monstarmos a tabela
            $dadosXls  = "";
            $dadosXls .= "  <table border='1' >";
            $dadosXls .= "      <tr>";
            $dadosXls .= "          <th>Data</th>";
            $dadosXls .= "          <th>Empreendimento</th>";
            $dadosXls .= "          <th>Nome</th>";
            $dadosXls .= "          <th>Email</th>";
            $dadosXls .= "          <th>Telefone</th>";
            $dadosXls .= "          <th>Mensagem</th>";
            $dadosXls .= "          <th>Interesse</th>";
            $dadosXls .= "          <th>Renda</th>";
            $dadosXls .= "          <th>Previsão de Compra</th>";
            $dadosXls .= "      </tr>";          

            foreach($leads AS $lead):

                $dadosXls .= "      <tr>";
                $dadosXls .= "          <td>".$lead['created_at']."</td>";
                
                if(isset($lead->empreendimento->nome)):
                    $dadosXls .= "          <td>".$lead->empreendimento->nome."</td>";
                else:
                    $dadosXls .= "          <td>".$lead->empreendimento_id."</td>";
                endif;

                $dadosXls .= "          <td>".$lead['nome']."</td>";
                $dadosXls .= "          <td>".$lead['email']."</td>";
                $dadosXls .= "          <td>".$lead['telefone']."</td>";
                $dadosXls .= "          <td>".$lead['mensagem']."</td>";
                $dadosXls .= "          <td>".$lead['interesse']."</td>";
                $dadosXls .= "          <td>".$lead['renda']."</td>";
                $dadosXls .= "          <td>".$lead['previsao']."</td>";
                $dadosXls .= "      </tr>";
                        
            endforeach;

            $dadosXls .= "  </table>";
        }

        $dadosXls = utf8_decode($dadosXls);

        // Definimos o nome do arquivo que será exportado  
        $arquivo = "Leads_PortalLancamentosOnline.xls";  
        // Configurações header para forçar o download  
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$arquivo.'"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');
        
        // Envia o conteúdo do arquivo  
        echo $dadosXls;  
        exit;

    }


    public function integracaoMrvHom()
    {       
        
        $empreendimento = Empreendimento::find(291);
        $client_id = "94EEC703-0C6A-433A-BD63-351AA1EE1DA2";

        if ($empreendimento->construtora_id == 13 && $client_id) {

            $dados = [
                "IdImovel" => $empreendimento->id,
                "NomeDoImovel" => ".$empreendimento->nome.",
                "Nome" => "Teste",
                "DDD" => "65",
                "Telefone" => "30252070",
                "Email" => "teste@lancamentosonline.com.br",
                "ClientID" => $client_id,
                "Origem" => "lancamentosonline",
                "ReceberNovidades" => 0,
                "Texto" => "Ola, tenho interesse no empreendimento Citta dei Fiori. Aguardo o contato. Obrigado.",
                "DataEnvio" => "2021-05-25 08:02:35",
                "Dispositivo" => "D"
            ];

            $client = new Client();
            
            $response = $client->post('https://cmsapi.mrv.com.br/api/formulario/classificados/cadastrar', [
                'json' => $dados
            ]);  
                                    
            echo $response->getStatusCode(); 
    
        }     

    }

    public function integracaoMrvNew()
    {
        $empreendimento = Empreendimento::find(291);
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
                        "Nome": "Teste", 
                        "DDD": "65", 
                        "Telefone": "930252070",  
                        "Celular": "30252070", 
                        "Email": "teste@lancamentosonline.com.br",
                        "Texto": "Ola, tenho interesse no empreendimento Citta dei Fiori. Aguardo o contato. Obrigado.",
                        "DataEnvio": "2021-05-25 08:02:35",
                        "ReceberNovidades": 0,
                        "Origem": "lancamentosonline",
                        "ClientID": "94EEC703-0C6A-433A-BD63-351AA1EE1DA2",
                        "Dispositivo": "D"
                    }';
    
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
            $response = curl_exec($curl);
            

            echo $response;
        } 

    }

    public function TestarEnvio($lead){
        
        $lead = Lead::find($lead);
        $adms = ['contato@lancamentosonline.com.br', 'edsongaldino@outlook.com'];
        Mail::to($adms)->send(new EmailAdm($lead));

        $contatos_construtora = $lead->construtora->usuarios->toArray();
        
        if ($contatos_construtora) {
            $destinatarios = array_column($contatos_construtora, 'email');
            Mail::to($destinatarios)->send(new EmailConstrutora($lead));
        }
    }

}
