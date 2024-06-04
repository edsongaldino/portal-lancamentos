<?php

namespace App\Models;

use App\Models\Assinatura;
use App\Models\BackpackUser;
use App\Models\ConstrutoraPerfil;
use App\Models\ContatoConstrutora;
use App\Models\Email;
use App\Models\Endereco;
use App\Models\Telefone;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;
use \DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Storage;

class Construtora extends Model
{
    use SoftDeletes, CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'construtoras';
    protected $fillable = [
        'nome',
        'nome_abreviado',
        'cnpj',
        'ano_fundacao',
        'mes_fundacao',
        'status',
        'valor_mensal',
        'acesso_domus'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getConstrutoraNome()
    {
        return $this->nome_abreviado ?? $this->nome;
    }

    public function getAutocomplete($texto)
    {
        return $this->where('construtoras.nome', 'like', "%{$texto}%")
            ->where('status', 'Liberada')
            ->get('nome')
            ->toArray();
    }

    public function getEmpreendimentos()
    {
        return $this->empreendimentos->where('status', '<>', 'Excluido');
    }

    public function getEmpreendimentosLiberados()
    {
        return $this->empreendimentos->where('status', '=', 'Liberada');
    }

    public function logo()
    {
        $logo = $this->logo;
        if ($logo) {
            $caminho = explode('/', $logo);

            if (isset($caminho[2])) {
                return $caminho[2];
            }

            return $logo;
        }
    }

    public function cadastrarConstrutora($nome, $cnpj)
    {
        $construtora = new Construtora();
        $construtora->nome = $nome;
        $construtora->nome_abreviado = $nome;
        $construtora->razao_social = $nome;
        $construtora->cnpj = $cnpj;
        $construtora->save();
        return $construtora;
    }

    public function atualizaIntegracao($request){

        $model = Construtora::find($request->id);
        $model->acesso_domus = $request->status;
        $model->save();

        return true;
    }

    public function cadastrarEnderecoConstrutora($request)
    {
        $endereco_id = (new Endereco())->cadastrar($request);
        $this->endereco_id = $endereco_id;
        $this->save();
    }

    public function cadastrarRelacionamentos($request, $id)
    {
        $construtora = $this->find($id);

        if ($request->logo) {
            $this->uploadLogoCortada($construtora, $request->logo);
        }

        $endereco_id = (new Endereco())->cadastrar($request);
        $construtora->endereco_id = $endereco_id;
        $construtora->save();

        (new Email())->cadastrar($request, $construtora);
        (new Telefone())->cadastrar($request, $construtora);
        (new Assinatura())->cadastrar($request, $construtora);
        (new ConstrutoraPerfil())->gerar($construtora->id);
    }

    public function atualizarRelacionamentos($request)
    {
        $construtora = $this;

        FacadesDB::beginTransaction();

        $this->uploadLogoCortada($construtora, $request->logo);

        if ($construtora->endereco) {
            $construtora->endereco->atualizar($request, $construtora);
        } else {
            (new Endereco())->cadastrar($request);
        }

        if ($construtora->emails->first()) {
            $construtora->emails->first()->atualizar($request, $construtora);
        } else {
            (new Email())->cadastrar($request, $construtora);
        }

        if ($construtora->telefones->first()) {
            $construtora->telefones->first()->atualizar($request, $construtora);
        } else {
            (new Telefone())->cadastrar($request, $construtora);
        }

        if ($construtora->assinatura->first()) {
            $construtora->assinatura->first()->atualizar($request, $construtora);
        } else {
            (new Assinatura())->cadastrar($request, $construtora);
        }

        if ($construtora->contatos->first()) {
            $construtora->contatos->first()->atualizar($request, $construtora);
        } else {
            (new ContatoConstrutora())->cadastrar($request, $construtora);
        }

        FacadesDB::commit();
    }

    public function salvarPerfilConstrutora($request, $id)
    {
        $construtora = $this->find($id);
        $construtora->cnpj = $request->cnpj;
        $construtora->ie = $request->ie;
        $construtora->razao_social = $request->razao_social;
        $construtora->nome = $request->nome;

        if ($request->mes) {
            $construtora->mes_fundacao = (int) $request->mes;
        }

        if ($request->ano) {
            $construtora->ano_fundacao = (int) $request->ano;
        }

        $construtora->observacoes = $request->observacoes;
        $construtora->save();

        $this->uploadLogo($request, $construtora);

        (new ConstrutoraPerfil())->marcarPerfil($construtora->id, 'Informações da Construtora');

        return true;
    }

    public function salvarEnderecoConstrutora($request, $id)
    {
        $construtora = $this->find($id);
        if ($construtora->endereco) {
            $construtora->endereco->first()->atualizar($request, $construtora);
        } else {
            $construtora->endereco_id = (new Endereco())->cadastrar($request);
            $construtora->save();
        }

        (new ConstrutoraPerfil())->marcarPerfil($construtora->id, 'Endereço da construtora');

        return true;
    }

    public function salvarCanaisAtendimento($request, $id)
    {
        $construtora = $this->find($id);
        $construtora->telefone = $request->telefone;
        $construtora->telefone_nun = $request->telefone_nun;
        $construtora->whatsapp = $request->whatsapp;
        $construtora->celular_atendimento = $request->celular_atendimento;
        $construtora->email = $request->email;
        $construtora->save();

        (new ConstrutoraPerfil())->marcarPerfil($construtora->id, 'Canais de Atendimento');

        return true;
    }

    public function salvarPerfilRedesSociais($request, $id)
    {
        $construtora = $this->find($id);
        $construtora->facebook = $request->facebook;
        $construtora->twitter = $request->twitter;
        $construtora->instagram = $request->instagram;
        $construtora->youtube = $request->youtube;
        $construtora->save();

        (new ConstrutoraPerfil())->marcarPerfil($construtora->id, 'Redes Sociais');

        return true;
    }

    public function uploadLogoCortada($construtora, $value)
    {
        $attribute_name = "logo";
        $disk = 'public';
        $destination_path = "construtora/{$construtora->id}/original/";

        if ($value == null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        if (starts_with($value, 'data:image')) {
            $image = \Image::make($value)->encode('png', 90);
            $filename = "construtora-{$construtora->id}.png";
            \Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $construtora->logo = 'uploads/' . $destination_path . $filename;
            $construtora->save();
            $this->gerarLogoTamanhos($construtora);
        }
    }

    public function uploadLogo($request, $construtora)
    {
        $campo = 'logo';
        if ($request->hasFile($campo)) {
            $request->validate([
                $campo => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $path = "uploads/construtora/{$construtora->id}/original/" . $request->file($campo)->storeAs("construtora/{$construtora->id}/original/", "construtora-{$construtora->id}.png");

            $construtora->logo = $path;
            $construtora->save();

            $this->gerarLogoTamanhos($construtora);

            return $path;
        }
    }

    public function gerarLogoTamanhos($construtora)
    {
        $tamanhos = [
            '125x95' => [
                'largura' => 125,
                'altura' => 95,

            ],
            '200x200' => [
                'largura' => 200,
                'altura' => 200,
            ],
            '260x260' => [
                'largura' => 260,
                'altura' => 260,
            ]
        ];

        $filename = "construtora-{$construtora->id}.png";

        foreach ($tamanhos as $pasta => $dimensoes) {
            $origem = public_path("uploads/construtora/{$construtora->id}/original/{$filename}");
            $destino = public_path("uploads/construtora/{$construtora->id}/{$pasta}/");

            if (!is_dir($destino)) {
                mkdir($destino, 0777, true);
                chmod($destino, 0777);
            }

            $img = Image::make($origem);

            // resize the image so that the largest side fits within the limit; the smaller
            // side will be scaled to maintain the original aspect ratio
            $img->resize($dimensoes['largura'], $dimensoes['altura'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save($destino . $filename);
        }
    }

    public function atualizarPlano($request, $construtora_id, $usuario_id)
    {
        $construtora = $this->find($construtora_id);
        $erros = null;
        $usuario = BackpackUser::find($usuario_id);

        $plano = strtolower($request->plano);
        $creditCardToken = $request->token;

        $subscriptionBuilder = $usuario->newSubscription($plano, $plano);

        $subscription = $subscriptionBuilder->create($creditCardToken, [
            'name' => $usuario->name,
            'street' => 'Rua 1',
            'district' => 'Cuiaba',
            'cpf_cnpj' => $usuario->cpf_cnpj,
            'zip_code' => '78098-654',
            'number' => '01',
        ]);

        if (!$subscription) {
            $this->verificarErrosAssinatura($subscriptionBuilder->getLastError());
        }

        $this->setIuguIdTodosUsuariosConstrutora($construtora, $usuario);

        return true;
    }

    public function verificarErrosAssinatura($erros)
    {
        if (is_array($erros)) {
            $lista = '';
            foreach ($erros as $key => $erro) {
                if ($key == 'zip_code') {
                    foreach ($erro as $valor) {
                        $lista .= "Cep: {$valor} <br/>";
                    }

                }

                if ($key == 'street') {
                    foreach ($erro as $valor) {
                        $lista .= "Rua: {$valor} <br/>";
                    }

                }

                if ($key == 'district') {
                    foreach ($erro as $valor) {
                        $lista .= "Cidade: {$valor} <br/>";
                    }

                }

            }
            throw new \Exception("Ocorreram os seguintes erros: {$lista}");
        } elseif($erros) {
            throw new \Exception("Ocorreu um erro: {$erros}");
        }
    }

    public function setIuguIdTodosUsuariosConstrutora($construtora, $usuario)
    {
        foreach ($construtora->usuarios as $integrante) {
            $integrante->iugu_id = $usuario->iugu_id;
            $integrante->save();
        }
    }

    public function getLogoUrl($pasta = 'original')
    {
        return url("uploads/construtora/{$this->id}/{$pasta}/construtora-{$this->id}.png");
    }

    public function getLogoPremium()
    {
        $logo_construtora = "assets/images/premium/construtora/logo_{$this->id}.png";

        if(file_exists($logo_construtora)){
            return $logo_construtora;
        }else{
            return url("assets/images/premium/logo_lancamentos.png");
        }

    }

    public function getPaginaUrl()
    {
        return url("/construtora/" . url_amigavel($this->nome_abreviado) . "-" . $this->id . ".html");
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function compradores()
    {
        return $this->hasMany('App\Models\CompradorUnidade');
    }

    public function lancamentosFinanceiros()
    {
        return $this->hasMany('App\Models\LancamentoFinanceiro');
    }

    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    public function contatos()
    {
        return $this->hasMany('App\Models\ContatoConstrutora')->where('situacao', 'Liberada');
    }

    public function empreendimentos()
    {
        return $this->hasMany('App\Models\Empreendimento');
    }

    public function unidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }

    public function endereco()
    {
        return $this->belongsTo('App\Models\Endereco');
    }

    public function tabelas()
    {
        return $this->hasMany('App\Models\TabelaVendas');
    }

    public function parceiros()
    {
        return $this->hasMany('App\Models\Parceiro');
    }

    public function emails()
    {
        return $this->hasMany('App\Models\Email');
    }

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }

    public function modalidades()
    {
        return $this->belongsToMany('App\Models\Modalidade', 'construtoras_modalidades');
    }

    public function tipoconstrutora()
    {
        return $this->belongsToMany('App\Models\Tipoconstrutora', 'construtoras_tipoconstrutoras');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Models\BackpackUser');
    }

    public function assinatura()
    {
        return $this->belongsToMany(
            'App\Models\Assinatura',
            'construtoras_assinaturas'
        );
    }

    public function perfil()
    {
        return $this->hasMany('App\Models\ConstrutoraPerfil');
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

    public function getValorMensalAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setValorMensalAttribute($valor)
    {
        $preco = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_mensal'] = $preco;
    }
}
