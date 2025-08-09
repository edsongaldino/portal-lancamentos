<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\EmpreendimentoPerfil;
use Illuminate\Support\Facades\File;
use App\Models\Planta;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DB;
use Illuminate\Pagination\LengthAwarePaginator;
use \Image;
use App\Models\Foto;
use App\Models\Estatistica;
use FarhanWazir\GoogleMaps\GMaps;

class Empreendimento extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'empreendimentos';
    protected $fillable = [
        'construtora_id',
        'nome',
        'descricao',
        'tipo',
        'valor_inicial',
        'valor_final',
        'previsao_entrega',
        'qtde_torre',
        'qtde_quadra',
        'latitude',
        'longitude',
        'status',
        'gerou_unidades',
        'logomarca'
    ];

    protected $registros = 20;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getQuadrasDisponiveis()
    {
        $quadras = $this->quadras;
        $array = [];
        foreach ($quadras as $quadra) {
            $unidades = $quadra->unidades->where('situacao', 'Disponível')->where('status', 'Liberada');
            if (count($unidades)) {
                $array[] = $quadra;
            }
        }

        return $array;
    }

    public function getTorresDisponiveis()
    {
        $torres = $this->torres;
        $array = [];
        foreach ($torres as $torre) {
            $unidades = $torre->unidades->where('situacao', 'Disponível')->where('status', 'Liberada');
            if (count($unidades)) {
                $array[] = $torre;
            }
        }

        return $array;
    }

    public function salvarDadosEmpreendimento($request, $id = null, $construtora_id)
    {
        $empreendimento = new Empreendimento();

        if ($id) {
            $empreendimento = $this->find($id);
        }

        $empreendimento->construtora_id = $construtora_id;
        $empreendimento->nome = $request->nome;
        $empreendimento->descricao = $request->descricao;
        $empreendimento->tipo = $request->tipo;
        $empreendimento->subtipo_id = $request->subtipo_id;
        $empreendimento->variacao_id = $request->variacao_id;
        $empreendimento->modalidade = $request->modalidade;
        $empreendimento->status = $request->status;

        if ($request->valor_inicial) {
            $empreendimento->valor_inicial = $request->valor_inicial;
        }

        if ($request->valor_final) {
            $empreendimento->valor_final = $request->valor_final;
        }

        $empreendimento->previsao_entrega = $request->previsao_entrega;

        $empreendimento->save();

        $logomarca = $this->uploadLogo($request, $empreendimento);

        if ($logomarca) {
            $empreendimento->logomarca = $logomarca;
            $empreendimento->save();
        }

        $this->atribuirCaracteristicasEmpreendimento($request, $empreendimento);

        (new EmpreendimentoPerfil())->gerar($empreendimento->id);

        (new EmpreendimentoPerfil())->marcarPerfil($empreendimento->id, 'Dados do empreendimento');

        return $empreendimento->id;
    }

    public function atribuirCaracteristicasEmpreendimento($request, $empreendimento)
    {
        $caracteristicas = [
            'previsao_condominio',
            'renda_familiar',
            'area_verde',
            'area_preservacao',
            'area_total',
            'planta_principal',
            'mostra_mapa',
            'disponibilidade_mapa',
            'ocultar_valor',
            'area_unidade_min',
            'area_unidade_max'
        ];

        $valores = [
            'previsao_condominio',
            'renda_familiar',
            'area_verde',
            'area_preservacao',
            'area_total',
            'area_unidade_min',
            'area_unidade_max'
        ];

        foreach ($caracteristicas as $caracteristica) {

            $parametros = array('');
            if(in_array($caracteristica,$valores)):
                $parametros["tipo"] = "valor";
            endif;
            atribuir_caracteristica_manual($request->{$caracteristica}, $empreendimento, 'Empreendimento', $caracteristica, $parametros);
        }

    }

    public function atribuirMidiasEmpreendimento($request, $empreendimento)
    {
        $caracteristicas = [
            'link_tour',
            'video',
            'instagram_empreendimento',
            'facebook_empreendimento'
        ];

        foreach ($caracteristicas as $caracteristica) {
            atribuir_caracteristica_manual($request->{$caracteristica}, $empreendimento, 'Empreendimento', $caracteristica);
        }
    }

    public function atribuirCanaisEmpreendimento($request, $empreendimento)
    {
        $caracteristicas = [
            'whatsapp_atendimento',
            'link_chat',
            'telefone_central',
            'email_lead',
            'email_proposta'
        ];

        foreach ($caracteristicas as $caracteristica) {
            atribuir_caracteristica_manual($request->{$caracteristica}, $empreendimento, 'Empreendimento', $caracteristica);
        }
    }

    public function atribuirHonorariosEmpreendimento($request, $empreendimento)
    {
        $caracteristicas = [
            'percentual_imobiliaria',
            'percentual_corretor',
            'percentual_lancamentos'
        ];

        foreach ($caracteristicas as $caracteristica) {
            atribuir_caracteristica_manual($request->{$caracteristica}, $empreendimento, 'Empreendimento', $caracteristica);
        }
    }

    public function salvarMidiasEmpreendimento($request, $id)
    {

        $empreendimento = $this->find($id);
        $this->atribuirMidiasEmpreendimento($request, $empreendimento);

        return true;

    }

    public function salvarCanaisEmpreendimento($request, $id)
    {

        $empreendimento = $this->find($id);
        $this->atribuirCanaisEmpreendimento($request, $empreendimento);

        return true;

    }

    public function salvarHonorariosIntermediacao($request, $id)
    {

        $empreendimento = $this->find($id);
        $this->atribuirHonorariosEmpreendimento($request, $empreendimento);

        return true;

    }

    public function geraPdfMapa($urlMapa)
    {

        $curl = curl_init();
        $apiChave = 'c3288f6d8d9b40ff801e67ef40591797';
            $params =  array (
            'source' => $urlMapa,
            'landscape' => 'true',
            'format' => 'A1',
            'auth' => array (
                'username' => 'user',
                'password' => 'passwd'
            )
        );

        curl_setopt_array ($curl, array (
            CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array ('Content-Type:application/json'),
            CURLOPT_USERPWD => $apiChave.':'
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (!empty($error)) {
            throw new \Exception($error);
        } elseif ($statusCode >= 400) {
            $body = json_decode($response, true);
            if (isset($body['error'])) {
                throw new \Exception($body['error']);
            } else {
                throw new \Exception($response);
            }
        }
        return $response;
    }

    public function geraPdfMapaVendas($urlMapa)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pdfshift.io/v3/convert/pdf",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(array(
                "source" => $urlMapa,
                "landscape" => false,
                "use_print" => false
            )),
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_USERPWD => 'api:c3288f6d8d9b40ff801e67ef40591797'
        ));

        $response = curl_exec($curl);
        return $response;
        //file_put_contents('wikipedia.pdf', $response);

    }

    public function uploadLogo($request, $empreendimento)
    {
        $campo = 'logomarca';
        if ($request->hasFile($campo)) {
            $request->validate([
                $campo => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $file = $request->file($campo);
            $filename = $file->getClientOriginalExtension();
            $path = $file->storeAs("empreendimento/{$empreendimento->id}/arquivo", $filename);
            return $filename;
        }
    }

    public function getEnderecoCompleto(array $dados = [])
    {
        $resultado = '';

        if (!isset($dados['endereco'])) {

            $cidade = $dados['cidade'];
            $bairro = $dados['bairro'];

            if ($dados['logradouro']) {
                $resultado .= "{$dados['logradouro']}";
            }

            if ($dados['complemento']) {
                $resultado .= ", {$dados['complemento']}";
            }

            if ($dados['numero']) {
                $resultado .= ", {$dados['numero']}";
            }

            if ($dados['bairro_comercial']) {
                $resultado .= ", {$dados['bairro_comercial']}";
            }

            if ($bairro) {
                $resultado .= ", {$bairro->nome}";
            }

            if ($cidade) {

                $resultado .= ", {$cidade->nome}";
            }

            if ($cidade->estado) {
                $resultado .= ", {$cidade->estado->nome}";
            }

            return $resultado;
        }

        $endereco = $dados['endereco'];

        if ($endereco) {
            if ($endereco->logradouro) {
                $resultado .= "{$endereco->logradouro}";
            }

            if ($endereco->complemento) {
                $resultado .= ", {$endereco->complemento}";
            }

            if ($endereco->numero) {
                $resultado .= ", {$endereco->numero}";
            }

            if ($endereco->bairro) {
                $resultado .= ", {$endereco->bairro->nome}";
            }

            if ($endereco->cidade) {
                $resultado .= ", {$endereco->cidade->nome}";
            }

            if ($endereco->cidade->estado) {
                $resultado .= ", {$endereco->cidade->estado->nome}";
            }

            if ($endereco->bairro_comercial) {
                $resultado .= ", {$endereco->bairro_comercial}";
            }

            return $resultado;
        }
    }

    public function getEnderecoEmpreendimento()
    {
        $resultado = '';

        if ($this->endereco) {

            if ($this->endereco->logradouro) {
                $resultado .= "{$this->endereco->logradouro}";
            }

            if ($this->endereco->numero) {
                $resultado .= ", {$this->endereco->numero}";
            }

            if ($this->endereco->complemento) {
                $resultado .= ", {$this->endereco->complemento}";
            }

            if ($this->endereco->bairro) {
                $resultado .= ", {$this->endereco->bairro->nome}";
            }

            if ($this->endereco->bairro_comercial) {
                $resultado .= ", {$this->endereco->bairro_comercial}";
            }

            if ($this->endereco->cidade) {
                $resultado .= ", {$this->endereco->cidade->nome}";

                if ($this->endereco->cidade->estado) {
                    $resultado .= ", {$this->endereco->cidade->estado->nome}";
                }
            }
        }

        return $resultado;
    }

    public function salvarEnderecoEmpreendimento($request, $id)
    {
        $empreendimento = $this->find($id);

        if ($empreendimento->endereco) {
            $empreendimento->endereco->atualizar($request, $empreendimento);
        } else {
            $endereco_id = (new Endereco())->cadastrar($request);
            $empreendimento->endereco_id = $endereco_id;
            $empreendimento->save();
        }

        $empreendimento = $this->find($id);

        $this->salvarDadosMapa($empreendimento->endereco, $request);

        //$this->atribuirCaracteristicasEmpreendimento($request, $empreendimento);

        (new EmpreendimentoPerfil())->marcarPerfil($id, 'Endereço');

        return true;
    }

    public function salvarEnderecoStand($request, $id)
    {
        $empreendimento = $this->find($id);

        if ($empreendimento->enderecoStand) {
            $empreendimento->enderecoStand->atualizarEnderecoStand($request, $empreendimento);
        } else {
            $endereco_id = (new Endereco())->cadastrar($request);
            $empreendimento->endereco_stand_id = $endereco_id;
            $empreendimento->save();
        }

        $empreendimento = $this->find($id);

        $this->salvarDadosMapa($empreendimento->enderecoStand, $request);

        //$this->atribuirCaracteristicasEmpreendimento($request, $empreendimento);

        (new EmpreendimentoPerfil())->marcarPerfil($id, 'Endereço');

        return true;
    }

    public function salvarDadosMapa($endereco, $request)
    {
        if ($request->marcar_mapa == 'Sim') {
            if ($request->latitude) {
                $endereco->latitude = $request->latitude;
                $endereco->save();
            }

            if ($request->longitude) {
                $endereco->longitude = $request->longitude;
                $endereco->save();
            }

            return true;
        }

        $gmap = new GMaps();

        try {
            $dados = $gmap->get_lat_long_from_address($this->getEnderecoCompleto([
                'endereco' => $endereco
            ]));
        } catch (\Exception $e) {
            $dados = [];
        }

        $endereco->latitude = isset($dados[0]) ? $dados[0] : null;
        $endereco->longitude = isset($dados[1]) ? $dados[1] : null;
        $endereco->save();
    }

    public function getLatitudeLongitude(array $dados)
    {
        $gmap = new GMaps();

        try {
            $dados = $gmap->get_lat_long_from_address($this->getEnderecoCompleto($dados));
        } catch (\Exception $e) {
            $dados = [];
        }

        return [
            'latitude' => isset($dados[0]) ? $dados[0] : null,
            'longitude' => isset($dados[1]) ? $dados[1] : null
        ];
    }

    public function salvarItensLazerEmpreendimento($request, $id)
    {
        $empreendimento = $this->find($id);

        $this->associarItensLazer($empreendimento, $request);

        (new EmpreendimentoPerfil())->marcarPerfil($id, 'Itens de Lazer');

        return true;
    }

    public function associarItensLazer($empreendimento, $request)
    {
        $caracteristicas = $request->item_lazer;

        $delete = $empreendimento->itensLazer()->get()->toArray();

        foreach ($delete as $item) {
            $empreendimento->itensLazer()->detach($item['id']);
        }

        if ($caracteristicas) {
            foreach ($caracteristicas as $caracteristica) {
                $empreendimento->itensLazer()->attach($caracteristica);
            }
        }
    }

    public function salvarCaracteristicasEmpreendimento($request, $id)
    {
        $empreendimento = $this->find($id);

        $this->associarCaracteristicasEmpreendimento($empreendimento, $request);

        (new EmpreendimentoPerfil())->marcarPerfil($id, 'Características');

        return true;
    }

    public function associarCaracteristicasEmpreendimento($empreendimento, $request)
    {
        $caracteristicas = $request->caracteristicas;

        $delete = $empreendimento->caracteristicas()->where('tipo', 'Empreendimento')->get()->toArray();

        foreach ($delete as $item) {
            $empreendimento->caracteristicas()->detach($item['id']);
        }

        if ($caracteristicas) {
            foreach ($caracteristicas as $caracteristica) {
                $empreendimento->caracteristicas()->attach($caracteristica);
            }
        }
    }

    public function excluir($request)
    {
        DB::beginTransaction();

        $id = $request->id;

        if ($id) {
            $empreendimento = $this->find($id);

            if ($empreendimento->tipo == 'Vertical') {
                if (!$this->verificarExclusaoVertical($empreendimento)) {
                    return false;
                }
            }

            if ($empreendimento->tipo == 'Horizontal') {
                if (!$this->verificarExclusaoHorizontal($empreendimento)) {
                    return false;
                }
            }

            $empreendimento->delete();
        }

        DB::commit();

        return true;
    }

    public function verificarExclusaoVertical($empreendimento)
    {
        $torres = $empreendimento->torres;

        if (!$torres) {
            return true;
        }

        foreach ($torres as $torre) {
            $unidades = $torre->unidades;
            if ($unidades) {
                foreach ($unidades as $unidade) {
                    // if ($unidade->situacao != 'Vendida') {
                    //     return false;
                    // }

                    $unidade->delete();
                }
            }
        }

        return true;
    }

    public function verificarExclusaoHorizontal($empreendimento)
    {
        $quadras = $empreendimento->quadras;

        if (!$quadras) {
            return true;
        }

        foreach ($quadras as $quadra) {
            $unidades = $quadra->unidades;
            if ($unidades) {
                foreach ($unidades as $unidade) {
                    // if ($unidade->situacao != 'Vendida') {
                    //     return false;
                    // }

                    $unidade->delete();
                }
            }
        }

        return true;
    }

    public function fotoPrincipal()
    {
        $foto = $this->fotos->where('destaque_principal', 'Sim')->first();

        if ($foto) {
            return url("uploads/empreendimento/{$foto->empreendimento_id}/400x300/{$foto->arquivo}");
        }

        return $this->logomarca;
    }

    public function fotoMapa()
    {
        $foto = $this->fotos->where('tipo', 'Implantação')->first();

        if ($foto) {
            return url("uploads/empreendimento/{$foto->empreendimento_id}/400x300/{$foto->arquivo}");
        }

        return $this->logomarca;
    }


    public function getFoto($tipo = 'destaque_principal')
    {
        $tamanhos = [
            'destaque_principal' => '400x300',
            //'miniatura' => '110x83',
            'destaque_carrossel' => 'original',
        ];

        $foto = $this->fotos->where($tipo, 'Sim')->first();
        if ($foto && isset($tamanhos[$tipo])) {
            return url("uploads/empreendimento/{$foto->empreendimento_id}/{$tamanhos[$tipo]}/{$foto->arquivo}");
        }
    }

    public function getFotoTipo($tipo = 'Decorado')
    {
        $foto = $this->fotos->where('tipo', $tipo)->first();
        if ($foto) {
            return url("uploads/empreendimento/{$foto->empreendimento_id}/original/{$foto->arquivo}");
        }
    }

    public function getFotosCarrossel()
    {
        return Foto::where('empreendimento_id', $this->id)
            ->where('destaque_carrossel', 'Sim')
            ->where(function ($q) {
                $q->orWhere('planta_id', null)
                  ->orWhere('planta_id', 0);
            })
            ->where('status', 'Liberada')
            ->get();
    }

    public function getFotosCarrosselMapa()
    {
        return Foto::where('empreendimento_id', $this->id)
            ->where('destaque_carrossel', 'Sim')
            ->where(function ($q) {
                $q->orWhere('planta_id', null)
                  ->orWhere('planta_id', 0);
            })
            ->where('status', 'Liberada')
            ->limit(3)->get();
    }

    public function getFotosMapa()
    {
        return Foto::where('empreendimento_id', $this->id)
            ->where('tipo', '<>', 'Implantação')
            ->where(function ($q) {
                $q->orWhere('planta_id', null)
                  ->orWhere('planta_id', 0);
            })
            ->where('status', 'Liberada')
            ->get();
    }

    public function ofertaPrincipal($parametro){

        if($parametro == 'valor-de'):
            $oferta = Oferta::where('validade', '>=', date('Y-m-d'))->whereNull('deleted_at')->where('empreendimento_id', $this->id)->select('ofertas.preco_tabela')->orderBy('ofertas.preco_tabela','asc')->first();
            if($oferta):
                return $oferta->preco_tabela;
            else:
                return '0.00';
            endif;
        endif;

        if($parametro == 'valor-por'):
            $oferta = Oferta::where('validade', '>=', date('Y-m-d'))->whereNull('deleted_at')->where('empreendimento_id', $this->id)->select('ofertas.preco_oferta')->orderBy('ofertas.preco_oferta','asc')->first();

            if($oferta):
                return $oferta->preco_oferta;
            else:
                return '0.00';
            endif;
        endif;

    }

    public function getLogo()
    {
        return url("uploads/empreendimento/{$this->id}/arquivo/{$this->logomarca}");
    }

    public function getUrlMapa()
    {
        $hash = $this->id*37;
        return "https://www.lancamentosonline.com.br/empreendimento/{$this->id}/{$hash}/visualizar-mapa/pdf";
    }

    public function getUnidadesDisponiveisQuadra(){
        return $this->unidades()
        ->select('unidades.*')
        ->join('quadras','unidades.quadra_id','=','quadras.id')
        ->where('quadras.status', 'Liberada')
        ->where('unidades.situacao', 'Disponível')
        ->get();
    }

    public function getUnidadesDisponiveisTorre(){
        return $this->unidades()
        ->select('unidades.*')
        ->join('torres','unidades.torre_id','=','torres.id')
        ->where('torres.status', 'Liberada')
        ->where('unidades.situacao', 'Disponível')
        ->get();
    }

    public function getUrlDisponibilidade()
    {
        return "https://www.lancamentosonline.com.br/empreendimento/{$this->id}/unidades/imprimir-disponibilidade";
    }

    public function getUrlCompleta()
    {
        return "https://www.lancamentosonline.com.br/imoveis/" . url_amigavel($this->subtipo->nome) . "-" . url_amigavel($this->nome). "-" . "{$this->id}.html";
    }

    public function getUrl()
    {
        return url("imoveis/" . url_amigavel($this->subtipo->nome) . "-" . url_amigavel($this->nome). "-" . "{$this->id}.html");
    }

    public static function isJoined($query, $table){
        $joins = collect($query->getQuery()->joins);
        return $joins->pluck('table')->contains($table);
    }

    public function scopeGetPorNomes($query, $nome)
    {
        return $query->whereLike('nome', $nome);
    }

    public function autocompleteGeral($texto)
    {
        $empreendimentos = $this->getAutocomplete($texto);
        $construtoras = (new Construtora())->getAutocomplete($texto);
        $cidades = (new Cidade())->getAutocomplete($texto);
        $bairros = (new Bairro())->getAutocomplete($texto);

        return array_merge($empreendimentos, $construtoras, $cidades, $bairros);
    }

    public function getAutocomplete($texto)
    {
        return $this->where('empreendimentos.nome', 'like', "%{$texto}%")
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('empreendimentos.status', 'Liberada')
            ->get('empreendimentos.nome')
            ->toArray();
    }

    public function buscar(array $parametros)
    {
        DB::enableQueryLog();

        $empreendimentos = $this->query();
        $ordenacao = isset($parametros['ordenacao']) ? $parametros['ordenacao'] : null;

        $empreendimentos->select('empreendimentos.*');
        $empreendimentos->where('empreendimentos.status', 'Liberada');
        $empreendimentos->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada');

        $this->buscarEstado($parametros, $empreendimentos);
        $this->buscarCidade($parametros, $empreendimentos);
        $this->buscarSubTipo($parametros, $empreendimentos);
        $this->buscarTipo($parametros, $empreendimentos);
        $this->buscarEmpreendimentoNome($parametros, $empreendimentos);
        $this->buscarEmpreendimentoId($parametros, $empreendimentos);
        $this->buscarConstrutoraMultiplo($parametros, $empreendimentos);
        $this->buscarConstrutora($parametros, $empreendimentos);
        $this->buscarSubtipoMultiplo($parametros, $empreendimentos);
        $this->buscarModalideMultiplo($parametros, $empreendimentos);
        $this->buscarCidadeMultiplo($parametros, $empreendimentos);
        $this->buscarEstadoMultiplo($parametros, $empreendimentos);
        $this->buscarBairroMultiplo($parametros, $empreendimentos);
        $this->buscarRangeValor($parametros, $empreendimentos);
        $this->buscarRangeQuarto($parametros, $empreendimentos);
        $this->buscarRangeArea($parametros, $empreendimentos);
        $this->buscarOferta($parametros, $empreendimentos);
        $this->buscaOrdenacao($parametros, $empreendimentos);
        $this->buscarModalidade($parametros, $empreendimentos);

        $empreendimentos->groupBy('empreendimentos.id');

        if (!$ordenacao) {
            $empreendimentos->orderBy('empreendimentos.valor_inicial', 'ASC');
        }

        $dados = $this->paginacao($empreendimentos, $parametros['page'], $parametros['querystring'], $parametros['url']);

        $this->salvarEstatistica($dados['resultados']);

        return [
            'resultados' => $dados['resultados'],
            'paginacao' => $dados['paginacao'],
            'total' => $dados['total'],
        ];
    }

    public function salvarEstatistica($empreendimentos)
    {
        foreach ($empreendimentos as $empreendimento) {
            (new Estatistica())->salvarVisualizacao($empreendimento);
        }
    }

    public function paginacao($empreendimentos, $page, $querystring, $url)
    {
        $query = $empreendimentos;
        $totalCount = $query->get()->count();
        $registros = $this->registros;

        if ($page) {
            $skip = $registros * ($page - 1);
            $query = $query->take($registros)->skip($skip);
        } else {
            $query = $query->take($registros)->skip(0);
        }

        $querystring = $querystring;
        $querystring = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/','', $querystring);
        $path = $url . '?' . $querystring;
        $resultados = $query->get();
        $dados = $resultados->toArray();

        $paginator = new LengthAwarePaginator($dados, $totalCount, $registros, $page);
        $paginator = $paginator->withPath($path);
        return [
            'paginacao' => $paginator,
            'resultados' => $resultados,
            'total' => $totalCount
        ];
    }

    public function buscarEstado($parametros, $empreendimentos)
    {
        $estado_id = isset($parametros['estado_id']) ? $parametros['estado_id'] : null;

        $empreendimentos->when($estado_id, function ($q) use ($estado_id, $empreendimentos) {

            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            $q->where('estado_id', $estado_id);
        });
    }

    public function buscarCidade($parametros, $empreendimentos)
    {
        $cidade_id = isset($parametros['cidade_id']) ? $parametros['cidade_id'] : null;

        $empreendimentos->when($cidade_id, function ($q) use ($cidade_id, $empreendimentos) {
            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            $q->where('cidade_id', $cidade_id);
        });
    }

    public function buscarSubTipo($parametros, $empreendimentos)
    {
        $subtipo_id = isset($parametros['subtipo_id']) ? $parametros['subtipo_id'] : null;

        $empreendimentos->when($subtipo_id, function ($q) use ($subtipo_id) {
            $q->where('empreendimentos.subtipo_id', $subtipo_id);
        });
    }

    public function buscarOferta($parametros, $empreendimentos)
    {
        $oferta = isset($parametros['oferta']) ? $parametros['oferta'] : null;

        $empreendimentos->when($oferta, function ($q) use ($oferta, $empreendimentos) {

            if (!self::isJoined($empreendimentos, 'ofertas')) {
                $q->join('ofertas', 'empreendimentos.id', '=', 'ofertas.empreendimento_id');
            }

            if(isset($parametros['construtora_id'])){
                $q->where('empreendimentos.construtora_id', $parametros['construtora_id']);
            }

            $data_atual = date("Y-m-d");
            $q->where('ofertas.validade',  '>=', $data_atual);
            $q->whereNull('ofertas.deleted_at');

        });
    }


    public function buscarTipo($parametros, $empreendimentos)
    {
        $tipo = isset($parametros['tipo']) ? $parametros['tipo'] : null;

        $empreendimentos->when($tipo, function ($q) use ($tipo) {
            if ($tipo == 'loteamentos') {
                $tipos = [
                    'loteamentos' => [10, 8]
                ];
                $q->join('empreendimentos_variacoes', 'empreendimentos.variacao_id', '=', 'empreendimentos_variacoes.id')
                    ->whereIn('variacao_id', $tipos[$tipo]);
            }
        });
    }

    public function buscarModalidade($parametros, $empreendimentos)
    {
        $modalidade = isset($parametros['modalidade']) ? $parametros['modalidade'] : null;
        $empreendimentos->when($modalidade, function ($q) use ($modalidade) {
            $q->where('empreendimentos.modalidade', $modalidade);
        });
    }

    public function buscarEmpreendimentoNome($parametros, $empreendimentos)
    {
        $busca_rapida = isset($parametros['busca_rapida']) ? $parametros['busca_rapida'] : null;

        $empreendimentos->when($busca_rapida, function ($q) use ($busca_rapida, $empreendimentos) {

            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->leftJoin('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            if (!self::isJoined($empreendimentos, 'cidades')) {
                $q->leftJoin('cidades', 'enderecos.cidade_id', '=', 'cidades.id');
            }

            if (!self::isJoined($empreendimentos, 'bairros')) {
                $q->leftJoin('bairros', 'enderecos.bairro_id', '=', 'bairros.id');
            }

            if (!self::isJoined($empreendimentos, 'construtoras')) {
                $q->leftJoin('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id');
            }

            $q->where(function ($query) use ($busca_rapida) {
                $query->where('empreendimentos.nome', 'like', "%{$busca_rapida}%");
                $query->orWhere('bairros.nome', 'like', "%{$busca_rapida}%");
                $query->orWhere('cidades.nome', 'like', "%{$busca_rapida}%");
                $query->orWhere('construtoras.nome', 'like', "%{$busca_rapida}%");
            });

        });
    }

    public function buscarConstrutoraMultiplo($parametros, $empreendimentos)
    {
        $construtora_id_multiplo = isset($parametros['construtora_id_multiplo']) ? $parametros['construtora_id_multiplo'] : null;

        $empreendimentos->when($construtora_id_multiplo, function ($q) use ($construtora_id_multiplo) {
            $q->whereIn('empreendimentos.construtora_id', $construtora_id_multiplo);
        });
    }

    public function buscarConstrutora($parametros, $empreendimentos)
    {
        $construtora_id = isset($parametros['construtora_id']) ? $parametros['construtora_id'] : null;

        $empreendimentos->when($construtora_id, function ($q) use ($construtora_id) {
            $q->where('empreendimentos.construtora_id', $construtora_id);
        });
    }

    public function buscarEmpreendimentoId($parametros, $empreendimentos)
    {
        $empreendimento_id = isset($parametros['empreendimento_id']) ? $parametros['empreendimento_id'] : null;

        $empreendimentos->when($empreendimento_id, function ($q) use ($empreendimento_id) {
            $q->where('empreendimentos.id', $empreendimento_id);
        });
    }

    public function buscarSubtipoMultiplo($parametros, $empreendimentos)
    {
        $subtipo_id_multiplo = isset($parametros['subtipo_id_multiplo']) ? $parametros['subtipo_id_multiplo'] : null;

        $empreendimentos->when($subtipo_id_multiplo, function ($q) use ($subtipo_id_multiplo) {
            $q->whereIn('empreendimentos.subtipo_id', $subtipo_id_multiplo);
        });
    }

    public function buscarEstadoMultiplo($parametros, $empreendimentos)
    {
        $estado_id_multiplo = isset($parametros['estado_id_multiplo']) ? $parametros['estado_id_multiplo'] : null;

        $empreendimentos->when($estado_id_multiplo, function ($q) use ($estado_id_multiplo, $empreendimentos) {
            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            $q->whereIn('estado_id', $estado_id_multiplo);
        });
    }

    public function buscarCidadeMultiplo($parametros, $empreendimentos)
    {
        $cidade_id_multiplo = isset($parametros['cidade_id_multiplo']) ? $parametros['cidade_id_multiplo'] : null;

        $empreendimentos->when($cidade_id_multiplo, function ($q) use ($cidade_id_multiplo, $empreendimentos) {
            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            $q->whereIn('cidade_id', $cidade_id_multiplo);
        });
    }

    public function buscarBairroMultiplo($parametros, $empreendimentos)
    {
        $bairro_id_multiplo = isset($parametros['bairro_id_multiplo']) ? $parametros['bairro_id_multiplo'] : null;

        $empreendimentos->when($bairro_id_multiplo, function ($q) use ($bairro_id_multiplo, $empreendimentos) {
            if (!self::isJoined($empreendimentos, 'enderecos')) {
                $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
            }

            $q->whereIn('bairro_id', $bairro_id_multiplo);
        });
    }

    public function buscarModalideMultiplo($parametros, $empreendimentos)
    {
        $modalidade_id_multiplo = isset($parametros['modalidade_id_multiplo']) ? $parametros['modalidade_id_multiplo'] : null;

        $empreendimentos->when($modalidade_id_multiplo, function ($q) use ($modalidade_id_multiplo) {
            $q->whereIn('empreendimentos.modalidade', $modalidade_id_multiplo);
        });
    }

    public function buscarRangeValor($parametros, $empreendimentos)
    {
        $valor_min = 0;
        $valor_max = 999999999999.99;

        if($parametros['valor_min'] <> null){
            $valor_min = converte_reais_to_mysql($parametros['valor_min']);
        }
        
        if($parametros['valor_max'] <> null){
            $valor_max = converte_reais_to_mysql($parametros['valor_max']);
        }

        $empreendimentos->when($valor_min, function ($q) use ($valor_min) {
            $q->whereRaw("empreendimentos.valor_inicial >= '{$valor_min}'");
        });

        $empreendimentos->when($valor_max, function ($q) use ($valor_max) {
            $q->whereRaw("empreendimentos.valor_final <= '{$valor_max}'");
        });
    }

    public function buscarRangeQuarto($parametros, $empreendimentos)
    {
        $quarto = isset($parametros['quarto']) ? $parametros['quarto'] : null;

        $empreendimentos->when($quarto, function ($q) use ($quarto, $empreendimentos) {

            if (!self::isJoined($empreendimentos, 'plantas')) {
                $q->join('plantas', 'empreendimentos.id', '=', 'plantas.empreendimento_id');
            }

            $range = explode('-', $quarto);

            $q->join(DB::raw('caracteristicas_plantas as c2'), function ($j) use ($range) {
                $j->on('plantas.id', '=', 'c2.planta_id')
                    ->whereRaw("c2.nome = 'qtd_dormitorio' AND c2.valor >= {$range[0]} AND c2.valor <= {$range[1]}");
            });
        });
    }

    public function buscarRangeArea($parametros, $empreendimentos)
    {
        $area = isset($parametros['area']) ? $parametros['area'] : null;

        $empreendimentos->when($area, function ($q) use ($area, $empreendimentos) {

            if (!self::isJoined($empreendimentos, 'plantas')) {
                $q->join('plantas', 'empreendimentos.id', '=', 'plantas.empreendimento_id');
            }

            $range = explode('-', $area);

            $q->join(DB::raw('caracteristicas_plantas as c3'), function ($j) use ($range) {
                $j->on('plantas.id', '=', 'c3.planta_id')
                    ->whereRaw("c3.nome = 'area_privativa_real' AND c3.valor >= {$range[0]} AND c3.valor <= {$range[1]}");
            });
        });
    }

    public function buscaOrdenacao($parametros, $empreendimentos)
    {
        $ordenacao = isset($parametros['ordenacao']) ? $parametros['ordenacao'] : null;

        $empreendimentos->when($ordenacao, function ($q) use ($empreendimentos, $ordenacao) {
            if ($ordenacao == 'maior_valor' || $ordenacao == 'menor_valor') {

                $ordem = $ordenacao == 'maior_valor' ? 'DESC' : 'ASC';

                $q->orderBy('empreendimentos.valor_inicial', $ordem);
            }

            if ($ordenacao == 'maior_area' || $ordenacao == 'menor_area') {

                $ordem = $ordenacao == 'maior_area' ? 'DESC' : 'ASC';

                if (!self::isJoined($empreendimentos, 'plantas')) {
                    $q->join('plantas', 'empreendimentos.id', '=', 'plantas.empreendimento_id');
                }

                $q->where('plantas.area_privativa', '<>', '');
                $q->where('plantas.area_privativa', '>', '0.00');
                $q->orderBy('plantas.area_privativa', $ordem);
            }
        });
    }

    public function filtrar($request, $construtora_id)
    {
        DB::enableQueryLog(); // Enable query log

        $empreendimentos = Empreendimento::query();

        $empreendimentos->where('construtora_id', $construtora_id);

        $empreendimentos->when($request->nome, function ($q) use ($request) {
            $q->where('empreendimentos.nome', 'like', "%{$request->nome}%");
        });

        $empreendimentos->when($request->subtipo_id, function ($q) use ($request) {
            if ($request->subtipo_id != 'Todas') {
                $q->where('subtipo_id', $request->subtipo_id);
            }
        });

        $empreendimentos->when($request->cidade_id, function ($q) use ($request, $empreendimentos) {
            if ($request->cidade_id != 'Todas') {
                if (!self::isJoined($empreendimentos, 'enderecos')) {
                    $q->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');
                }

                $q->where('cidade_id', $request->cidade_id);
            }
        });

        $empreendimentos->when($request->status, function ($q) use ($request) {
            if ($request->status != 'Todas') {
                $q->where('status', $request->status);
            } else {
                $q->where('status', '<>' , 'Excluido');
            }
        });

        return $empreendimentos->get();
    }

    public function getCaracteristica($nome, $tipo = 'unico')
    {
        switch ($tipo) {
            case 'minimo':
                $valores = $this->getTodosValoresCaracteristica($nome);
                return min($valores);
            break;

            case 'maximo':
                $valores = $this->getTodosValoresCaracteristica($nome);
                return max($valores);
            break;

            case 'minimo_planta':
                $valores = $this->getTodosValoresCaracteristicaPlanta($this->plantas, $nome);
                if ($valores) {
                    return min($valores);
                }
            break;

            case 'maximo_planta':
                $valores = $this->getTodosValoresCaracteristicaPlanta($this->plantas, $nome);
                if ($valores) {
                    return max($valores);
                }

            break;

            default:
                $caracteristica = $this->caracteristicas->where('nome', $nome)->first();
                if ($caracteristica) {
                    return $caracteristica->pivot->valor;
                }
            break;
        }
    }

    public function getTodosValoresCaracteristica($nome)
    {
        $caracteristica = $this->caracteristicas->where('nome', $nome);
        $valores = [];
        foreach ($caracteristica as $c) {
            if ($c->pivot->valor) {
                $valores[] = $c->pivot->valor;
            }
        }

        return $valores;
    }

    public function getTodosValoresCaracteristicaPlanta($plantas, $nome)
    {
        $valores = [];

        foreach ($plantas as $planta) {

            $caracteristica = $planta->caracteristicas->where('nome', $nome);

            foreach ($caracteristica as $c) {
                if ($c->pivot->valor) {
                    $valores[] = $c->pivot->valor;
                }
            }
        }

        return $valores;
    }

    public function similares()
    {
        $resultados =  Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('subtipo_id', $this->subtipo->id)
            ->where('modalidade', $this->modalidade)
            ->join('enderecos', 'empreendimentos.endereco_id', '=', 'enderecos.id');

        if ($this->endereco && $this->endereco->cidade->estado) {
            $resultados->where('estado_id', $this->endereco->cidade->estado->id);
        }

        return $resultados->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function similares2()
    {
        return Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('subtipo_id', $this->subtipo->id)
            ->where('modalidade', $this->modalidade)
            ->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.valor_inicial', '<=', $this->valor_inicial)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function similares3()
    {
        return Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('subtipo_id', $this->subtipo->id)
            ->where('modalidade', $this->modalidade)
            ->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function similares4()
    {
        return Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('subtipo_id', $this->subtipo->id)
            ->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function similares5()
    {
        return Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('modalidade', $this->modalidade)
            ->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function similares6()
    {
        return Empreendimento::select('empreendimentos.*')
            ->join('construtoras', 'empreendimentos.construtora_id', '=', 'construtoras.id')
            ->where('construtoras.status', 'Liberada')
            ->where('empreendimentos.id', '<>', $this->id)
            ->where('empreendimentos.status', 'Liberada')
            ->limit(8)
            ->get();
    }

    public function isFotosClassificadas()
    {
        $fotos = $this->fotos;

        if ($fotos->count() < 5) {
            return false;
        }

        $destaque_principal = false;
        $destaque_carrossel = 0;
        $classificadas = 0;

        foreach ($fotos as $foto) {
            if ($foto->tipo != 'Geral') {
                $classificadas++;
            }

            if (!$foto->nome) {
                return false;
            }

            if ($foto->destaque_principal == 'Sim') {
                $destaque_principal = true;
            }

            if ($foto->destaque_carrossel == 'Sim') {
                $destaque_carrossel++;
            }
        }


        if (!$destaque_principal) {
            return false;
        }

        if ($destaque_carrossel < 5) {
            return false;
        }

        if ($classificadas < 5) {
            return false;
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    public function arquivos()
    {
        return $this->hasMany('App\Models\EmpreendimentoArquivos');
    }

    public function estatistica()
    {
        return $this->hasMany('App\Models\Estatistica');
    }

    public function resumo_estatistica()
    {
        return $this->hasMany('App\Models\ResumoEstatistica');
    }

    public function seo()
    {
        return $this->belongsTo('App\Models\Seo');
    }

    public function unidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }

    public function garagens()
    {
        return $this->hasMany('App\Models\Garagem');
    }

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function andares()
    {
        return $this->hasManyThrough('App\Models\Andar', 'App\Models\Torre');
    }

    public function quadras()
    {
        return $this->hasMany('App\Models\Quadra');
    }

    public function torres()
    {
        return $this->hasMany('App\Models\Torre');
    }

    public function plantas()
    {
        return $this->hasMany('App\Models\Planta');
    }

    public function plantasComFotos()
    {
        return $this->hasMany('App\Models\Planta')->select('plantas.*')->join('fotos', 'plantas.id', '=', 'fotos.planta_id')->groupBy('plantas.id');
    }

    public function ofertas()
    {
        return $this->hasMany('App\Models\Oferta');
    }

    public function tour()
    {
        return $this->hasMany('App\Models\TourVirtual');
    }

    public function tabelas()
    {
        return $this->hasMany('App\Models\TabelaVendas');
    }

    public function tabela()
    {
        return $this->belongsTo('App\Models\TabelaVendas');
    }

    public function TabelaAtiva()
    {
        return $this->hasMany('App\Models\TabelaVendas')->where('validade_tabela', '>=', (new \DateTime())->format('Y-m-d'))->whereNull('deleted_at');
    }

    public function ofertasAtivas()
    {
        return $this->hasMany('App\Models\Oferta')->where('validade', '>=', (new \DateTime())->format('Y-m-d'))->whereNull('deleted_at');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_empreendimentos')->where('tipo', 'Empreendimento')->withPivot('valor');
    }

    public function itensLazer()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_empreendimentos')->where('tipo', 'Lazer');
    }

    public function caracteristicasEmpreendimento()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_empreendimentos')->where('tipo', 'Empreendimento')->where('exibir', 'Sim');
    }

    public function endereco()
    {
        return $this->belongsTo('App\Models\Endereco')->withDefault();
    }

    public function enderecoStand()
    {
        return $this->belongsTo('App\Models\Endereco', 'endereco_stand_id');
    }

    public function perfil()
    {
        return $this->hasMany('App\Models\EmpreendimentoPerfil');
    }

    public function fotos()
    {
        return $this->hasMany('App\Models\Foto');
    }

    public function subtipo()
    {
        return $this->belongsTo('App\Models\Subtipo');

    }

    public function variacao()
    {
        return $this->belongsTo('App\Models\Variacao');

    }

    public function pavimentos()
    {
        return $this->hasMany('App\Models\PavimentoGaragem');

    }

    public function historicoUnidades()
    {
        return $this->hasMany('App\Models\HistoricoAlteracaoUnidade');

    }

    public function compradores()
    {
        return $this->hasMany('App\Models\CompradorUnidade');
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

    public function getValorInicialAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 0, ',', '.');
        }
    }

    public function getValorFinalAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 0, ',', '.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setValorInicialAttribute($valor)
    {
        $valor_inicial = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_inicial'] = $valor_inicial;
    }

    public function setValorFinalAttribute($valor)
    {
        $valor_final = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_final'] = $valor_final;
    }
}
