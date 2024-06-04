<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Empreendimento;
use Illuminate\Support\Facades\DB;
use \Image;
use Illuminate\Support\Facades\File;

class Foto extends Model
{
    use SoftDeletes;
    
    	/*
        |--------------------------------------------------------------------------
        | GLOBAL VARIABLES
        |--------------------------------------------------------------------------
        */

        protected $table = 'fotos';
        protected $fillable = [
            'construtora_id',
        	'nome',
        	'descricao',
        	'arquivo',
        	'extensao',
            'planta_id',
            'status',
            'tipo_ponto',
            'destaque_principal'
        ];

        /*
        |--------------------------------------------------------------------------
        | FUNCTIONS
        |--------------------------------------------------------------------------
        */

        public function atualizar($request, $id, $construtora_id)
        {
            $foto = $this->find($id);
            $foto->construtora_id = $construtora_id;

            if ($request->nome) {
                $foto->nome = $request->nome;
            }
            
            if ($request->descricao) {
                $foto->descricao = $request->descricao;
            }

            if ($request->tipo) {
                $foto->tipo = $request->tipo;                
            }
            
            $foto->save();

            $caracteristicas = [
                'data_implantacao',
            ];

            atribuir_caracteristica($request, $foto, 'Foto', $caracteristicas);

            $empreendimento = Empreendimento::find($foto->empreendimento_id);
            
            if ($empreendimento->isFotosClassificadas()) {
                $empreendimento->status = 'Liberada';
                $empreendimento->save();
            }

            return true;
        }

        public function excluir($request)
        {
            $ids = $request->ids;

            foreach($ids as $id):
                $foto = Foto::find($id);
                File::delete(
                    ["uploads/empreendimento/{$foto->empreendimento_id}/original/{$foto->arquivo}"], 
                    ["uploads/empreendimento/{$foto->empreendimento_id}/400x300/{$foto->arquivo}"],
                    ["uploads/empreendimento/{$foto->empreendimento_id}/262x221/{$foto->arquivo}"],
                    ["uploads/empreendimento/{$foto->empreendimento_id}/110x83/{$foto->arquivo}"]
                );
            endforeach;

            if ($ids) {
                $this->destroy($ids);
            }

            return true;
        }

        public function destacarFotoPrincipal($request)
        {
            $ids = $request->ids;

            foreach ($ids as $id) {
                $model = Foto::find($id);

                $existe = $this->verificarExistenciaFotoPrincipal($model->empreendimento_id);

                if ($existe) {
                    return false;
                }

                $model->destaque_principal = 'Sim';
                $model->save();
            }

            return true;
        }

        public function verificarExistenciaFotoPrincipal($empreendimento_id)
        {
            $fotos = Empreendimento::find($empreendimento_id)->fotos;
            foreach ($fotos as $foto) {
                if ($foto->destaque_principal == 'Sim') {
                    return true;
                }
            }
        }

        public function removerDestaquePrincipal($request)
        {
            $ids = $request->ids;

            foreach ($ids as $id) {
                $model = Foto::find($id);
                $model->destaque_principal = 'Não';
                $model->save();
            }

            return true;
        }

        public function destacarFotoCarrossel($request)
        {
            $ids = $request->ids;

            foreach ($ids as $id) {
                $model = Foto::find($id);
                $model->destaque_carrossel = 'Sim';
                $model->save();
            }

            return true;
        }

        public function removerDestaqueCarrossel($request)
        {
            $ids = $request->ids;

            foreach ($ids as $id) {
                $model = Foto::find($id);
                $model->destaque_carrossel = 'Não';
                $model->save();
            }

            return true;
        }

        public function getCaminho($tipo = 'original')
        {
            return public_path("uploads/empreendimento/{$this->empreendimento_id}/{$tipo}/{$this->arquivo}");
        }

        public function getUrl($tipo = 'original')
        {
            return url("uploads/empreendimento/{$this->empreendimento_id}/{$tipo}/{$this->arquivo}");
        }

        public function getTamanho($tipo = 'original')
        {
            $imagem =  public_path("uploads/empreendimento/{$this->empreendimento_id}/{$tipo}/{$this->arquivo}");
            list($largura, $altura) = getimagesize($imagem);
            return $largura.'x'.$altura;
        }

        public function atualizarCoordenadas($request)
        {
            $model = $this->findOrFail($request->foto_id);

            $model->coord_x = $request->coord_x;
            $model->coord_y = $request->coord_y;
            $model->save();
            return true;
        }

        public function adicionarMarcaDaAgua()
	    {                        
            $destino = public_path("uploads/empreendimento/{$this->empreendimento_id}/original/");
            $img = Image::make($this->getCaminho());
            $img->insert(public_path('site/imagens/marca_agua_lancamentosonline.png'), 'bottom-right', 10, 40);
            $img->save($destino . $this->arquivo);
        }
        
        public function gerarFotoTamanhos()
        {
            $tamanhos = [
                '400x300' => [
                    'largura' => 400,
                    'altura' => 300,

                ],
                '110x83' => [
                    'largura' => 110,
                    'altura' => 83,
                ],
                '262x221' => [
                    'largura' => 262,
                    'altura' => 221,
                ],
            ];

            foreach ($tamanhos as $pasta => $dimensoes) {
                $origem = public_path("uploads/empreendimento/{$this->empreendimento_id}/original/{$this->arquivo}");
                $destino = public_path("uploads/empreendimento/{$this->empreendimento_id}/{$pasta}/");			

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

                $img->save($destino . $this->arquivo);
            }
        }

        public function salvarFotosEmpreendimento($request, $id, $construtora_id)
        {        
            try {
                $empreendimento = (new Empreendimento())->find($id);
                
                $file = $request->file('file');

                if ($file) {

                    if (!$this->validarExtensao($file)) {
                        return false;
                    }

                    $fileName = str_replace(' ', '_', $file->getClientOriginalName());
                    $file->move("uploads/empreendimento/{$empreendimento->id}/original", $fileName);
                    $empreendimento->fotos()->create([
                        'construtora_id' => $construtora_id,          
                        'nome' => $fileName,
                        'arquivo' => $fileName,
                        'extensao' => \File::extension($fileName),
                        'status' => 'Liberada'
                    ]);        

                    $ultimo_id = \DB::getPDO()->lastInsertId();
                    $foto = Foto::find($ultimo_id);
                    //$foto->adicionarMarcaDaAgua();
                    $foto->gerarFotoTamanhos();
                }

                return true;
            } catch (\Exception $e) {
                return false;
            }        
        }

        public function salvarFotos(array $parametros)
        {                    
            $request = $parametros['request'];

            foreach ($parametros['arquivos'] as $arquivo) {                
                if ($request->hasFile($arquivo)) {

                    $file = $request->file($arquivo);
                    
                    if (!$this->validarExtensao($file)) {
                        return false;
                    }

                    $empreendimento = (new Empreendimento())->find($parametros['empreendimento_id']);
                    
                    $fileName = str_replace(' ', '_', $file->getClientOriginalName());
                    $file->move("uploads/empreendimento/{$empreendimento->id}/original", $fileName);
                    
                    $empreendimento->fotos()->create([
                        'construtora_id' => $parametros['construtora_id'],
                        'planta_id' => isset($parametros['planta_id']) ? $parametros['planta_id'] : null,
                        'nome' => $fileName,
                        'arquivo' => $fileName,
                        'extensao' => File::extension($fileName),
                        'status' => 'Liberada',
                        'tipo_ponto' => null,
                        'destaque_planta' => $arquivo == 'foto_planta' || $arquivo == 'foto_primeira_planta' ? 'Sim' : 'Não'
                    ]);  

                    $ultimo_id = \DB::getPDO()->lastInsertId();
                    $foto = Foto::find($ultimo_id);
                    //$foto->adicionarMarcaDaAgua();
                    $foto->gerarFotoTamanhos();
                    $this->setFotoPlanta($ultimo_id, $parametros['planta_id'], $arquivo);
                }                            
            }            
            
            return true;           
        }

        public function validarExtensao($file)
        {
            $extensao = $file->extension();

            $extensoes = [
                'jpeg',
                'png',
                'jpg'
            ];

            return in_array($extensao, $extensoes);            
        }

        private function setFotoPlanta($id, $planta_id, $arquivo)
        {
            if ($planta_id) {
                $planta = Planta::find($planta_id);

                if ($arquivo == 'foto_planta') {
                    $planta->foto_planta = $id;
                }

                if ($arquivo == 'foto_primeira_planta') {
                    $planta->foto_primeira_planta = $id;
                    $planta->foto_planta = $id;
                }

                if ($arquivo == 'foto_segunda_planta') {
                    $planta->foto_segunda_planta = $id;
                }

                if ($arquivo == 'foto_terceira_planta') {
                    $planta->foto_terceira_planta = $id;
                }

                $planta->save();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | RELATIONS
        |--------------------------------------------------------------------------
        */

        public function empreendimento()
        {
        	return $this->belongsTo('App\Models\Cidade');
        }

        public function planta()
        {
            return $this->belongsTo('App\Models\Planta');
        }

        public function caracteristicas()
        {
            return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_fotos')->withPivot('valor');
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
