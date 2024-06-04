<?php

use App\Models\BackpackUser;
use Illuminate\Http\Request;
use App\Models\Empreendimento;
use App\Models\Construtora;
use App\Models\Planta;
use App\Models\Torre;
use App\Models\Quadra;
use App\Models\Unidade;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Bairro;
use App\Models\Caracteristica;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/caracteristicas/{tipo}', function ($tipo) {
    return Caracteristica::where([['caracteristicas.tipo',$tipo],['caracteristicas.exibir','Sim']])->get();
});

Route::middleware('auth:api')->get('/estados', function () {
    return Estado::All();
});

Route::middleware('auth:api')->get('/cidades', function () {
    return Cidade::All();
});

Route::middleware('auth:api')->get('/bairros', function () {
    return Bairro::All();
});

Route::middleware('auth:api')->get('/empreendimentos', function () {
    return Empreendimento::All();
});

Route::middleware('auth:api')->get('/empreendimento/{id}', function ($id) {
    return Empreendimento::find($id);
});

Route::middleware('auth:api')->get('/empreendimento/{id}/torres', function ($id) {
    return Empreendimento::find($id)->torres;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/quadras', function ($id) {
    return Empreendimento::find($id)->quadras;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/unidades', function ($id) {
    return Empreendimento::where('empreendimentos.id',$id)->join('unidades','unidades.empreendimento_id','=','empreendimentos.id')->leftjoin('andares','unidades.andar_id','=','andares.id')->select('unidades.*', 'andares.numero')->get();
});

Route::middleware('auth:api')->get('/unidade/{id}/caracteristicas', function ($id) {
    $unidade = Unidade::find($id);
    if($unidade):
        return $unidade->caracteristicas;
    endif;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/fotos', function ($id) {
    return Empreendimento::find($id)->fotos;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/itens-lazer', function ($id) {
    return Empreendimento::find($id)->itensLazer;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/caracteristicas', function ($id) {
    return Empreendimento::find($id)->caracteristicas;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/infra-estruturas', function ($id) {
    return Empreendimento::select('caracteristicas.*')->join('caracteristicas_empreendimentos','caracteristicas_empreendimentos.empreendimento_id','=','empreendimentos.id')->join('caracteristicas','caracteristicas.id','=','caracteristicas_empreendimentos.caracteristica_id')->where([['empreendimentos.id',$id],['caracteristicas.exibir','Sim']])->get();
});

Route::middleware('auth:api')->get('/empreendimento/{id}/leads', function ($id) {
    return Empreendimento::find($id)->leads;
});

Route::middleware('auth:api')->get('/empreendimento/{id}/plantas', function ($id) {
    return Empreendimento::find($id)->plantas;
});

Route::middleware('auth:api')->get('/planta/{id}/caracteristicas', function ($id) {
    return Planta::find($id)->caracteristicas;
});

Route::middleware('auth:api')->get('/torre/{id}/caracteristicas', function ($id) {
    return Torre::find($id)->caracteristicas;
});

Route::middleware('auth:api')->get('/quadra/{id}/caracteristicas', function ($id) {
    return Quadra::find($id)->caracteristicas;
});

Route::middleware('auth:api')->get('/construtoras', function () {
    return Construtora::All();
});

Route::middleware('auth:api')->get('/construtora/{id}/usuarios', function ($id) {
    return BackpackUser::select('users.*','roles.id as id_perfil','roles.name as nome_perfil')->join('model_has_roles','model_has_roles.model_id','=','users.id')->join('roles','model_has_roles.role_id','=','roles.id')->where('users.construtora_id',$id)->get();
});

Route::middleware('auth:api')->get('/construtora/{id}/enderecos', function ($id) {
    return Construtora::find($id)->enderecos;
});

Route::middleware('auth:api')->get('/construtora/{id}', function ($id) {
    return Construtora::where('construtoras.id',$id)->join('enderecos','enderecos.id','=','construtoras.endereco_id')->join('bairros','enderecos.bairro_id','=','bairros.id')->join('cidades','enderecos.cidade_id','=','cidades.id')->join('estados','enderecos.estado_id','=','estados.id')->select('construtoras.*','enderecos.cep','enderecos.logradouro','enderecos.complemento','enderecos.numero','enderecos.estado_id','enderecos.cidade_id','enderecos.bairro_id','bairros.nome AS nome_bairro','cidades.nome AS nome_cidade','estados.uf AS uf_estado')->get();
});