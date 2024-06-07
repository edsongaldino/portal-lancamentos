<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas de login

use App\Models\Empreendimento;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::group(
[
    'middleware' => 'web',
    'prefix'     => config('backpack.base.route_prefix'),
],
function () {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('backpack.auth.login');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('logout', 'Auth\LoginController@logout')->name('backpack.auth.logout');
	Route::post('logout', 'Auth\LoginController@logout');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email');

});

Route::group(['middleware' => ['site']], function () {

	Route::get('/', function () {
		return redirect('pagina-inicial.html');
	});

    //Rotas Página Comercial
    Route::get('plataforma-lancamentos-online.html', 'Site\HomeController@PaginaComercial')->name('comercial');
	Route::post('/pagina-comercial/captar-dados-cliente', 'Site\HomeController@ContatoComercial');

	// Home
	Route::get('pagina-inicial.html', 'Site\HomeController@NovaIndex')->name('homepage');


	Route::get('/sitemap.xml', 'Site\HomeController@SiteMap');

	// Noticia
	Route::get('/artigo/{id}/{titulo}', 'Site\NoticiaController@index')->where([
		'titulo' => '(.*)',
		'id' => '([0-9]+)'
	]);

	// Pagina de busca
	Route::get('resultado-busca', 'Site\BuscaController@index');
	Route::post('resultado-busca', 'Site\BuscaController@ajax');
	Route::get('/empreendimentos-em-{cidade}-{id}.html', 'Site\BuscaController@cidade')->where(['cidade' => '(.*)', 'id' => '([0-9]+)']);

	Route::get('/imoveis-em-{cidade}-{id}.html', 'Site\BuscaController@cidade')->where([
		'cidade' => '(.*)',
		'id' => '([0-9]+)'
	]);

	Route::get('/empreendimentos-no-{regiao}-{id}.html', 'Site\BuscaController@Regiao')->where([
		'regiao' => '(.*)',
		'id' => '([0-9]+)'
	]);

	//Emprendimentos em Oferta

	Route::get('/ofertas/black-friday-empreendimentos-com-descontos-incriveis.html', 'Site\BuscaController@oferta')->where([
		'oferta' => 'Sim'
	]);
	Route::get('/ofertas/1-empreendimentos-com-descontos-incriveis.html', 'Site\BuscaController@oferta')->where([
		'oferta' => 'Sim'
	]);

	Route::get('/ofertas/{construtora_id}/{construtora}-empreendimentos-em-oferta.html', 'Site\BuscaController@oferta')->where([
		'oferta' => 'Sim',
		'construtora' => '(.*)',
		'construtora_id' => '([0-9]+)'
	]);

	// Ajax da busca

	Route::post('buscar-cidade2', 'Admin\CidadeController@buscarCidade2')->name('buscar-cidade-site');

	// Ajax autocomplete busca

	Route::post('autocomplete-geral', 'Site\BuscaController@autocompleteGeral');

	// Empreendimento

	Route::get('/imoveis/{empreendimento}-{id}.html', 'Site\EmpreendimentoController@index')->where([
		'empreendimento' => '(.*)',
		'id' => '([0-9]+)'
	]);

	Route::post('contato-construtora', 'Site\EmpreendimentoController@contato')->name('contato-construtora');
	Route::post('chat-empreendimento', 'Site\EmpreendimentoController@ChatEmpreendimento')->name('chat-empreendimento');


	Route::post('/buscar-cliente', 'Site\EmpreendimentoController@buscarCliente');
	Route::post('/carregar-oferta', 'Site\EmpreendimentoController@oferta');
	Route::post('/enviar-proposta', 'Site\EmpreendimentoController@enviarProposta');
	Route::post('/unidade/mapa', 'Site\EmpreendimentoController@unidadeMapa');
    Route::post('/unidade/dimensao-lote', 'Site\EmpreendimentoController@dimensaoLote');


	Route::get('/unidade/mapa/{id}', 'Site\EmpreendimentoController@GetunidadeMapa');

	Route::get('/empreendimento/{id}/mapa', 'Site\EmpreendimentoController@mapa');
	Route::get('/empreendimento/proposta/{id}', 'Site\EmpreendimentoController@proposta');
	Route::post('/garagem/mapa', 'Site\EmpreendimentoController@garagemMapa');



	//Layout Proposta Online (PREMIUM)
	Route::get('/empreendimento/{id}/premium', 'Site\EmpreendimentoController@premium');
	Route::get('/empreendimento/{id}/unidades', 'Site\EmpreendimentoController@unidades');
	Route::get('/proposta/unidade/{id}', 'Site\EmpreendimentoController@unidade');
	Route::get('/unidade/{id}/formular-proposta', 'Site\EmpreendimentoController@formularProposta');
	Route::get('/unidade/{id}/gravar-dados', 'Site\EmpreendimentoController@DadosProposta');
	Route::get('/unidade/{id}/condicoes-construtora', 'Site\EmpreendimentoController@CondicoesConstrutora');
	Route::get('/unidade/{id}/conferir-proposta', 'Site\EmpreendimentoController@conferirProposta');
	Route::get('/empreendimento/foto/{id}/restore', 'Site\EmpreendimentoController@RestoreFoto');

	Route::post('/empreendimento/enviar-contato-cliente', 'Site\EmpreendimentoController@ContatoConstrutora');

	Route::post('/proposta/gravar-dados-cliente', 'Site\PropostaController@GravarDadosCliente');
	Route::post('/proposta/gravar-dados-proposta', 'Site\PropostaController@GravarDadosProposta');
	Route::post('/proposta/atualizar-dados-proposta', 'Site\PropostaController@AtualizarDadosProposta');
	Route::get('/proposta/{id}/editar-proposta', 'Site\PropostaController@EditarProposta');
	Route::post('/proposta/enviar-proposta', 'Site\PropostaController@EnviarProposta');
	Route::post('/proposta/buscar-vaga', 'Site\PropostaController@BuscarVaga');
	Route::post('/proposta/gravar-vaga', 'Site\PropostaController@GravarVagaProposta');
	Route::post('/proposta/remover-vaga', 'Site\PropostaController@RemoverVagaProposta');
    Route::post('/proposta/gravar-vaga-extra', 'Site\PropostaController@GravarVagaExtra');

	Route::get('/proposta/{id}/conferir-proposta', 'Site\PropostaController@ConferirProposta');

	Route::get('/proposta/{id}/layout-proposta', 'Site\PropostaController@layoutProposta');


	Route::get('/empreendimento/{id}/plantas', 'Site\EmpreendimentoController@plantas');
	Route::get('/empreendimento/{id}/fotos', 'Site\EmpreendimentoController@fotos');
	Route::get('/empreendimento/{id}/garagem', 'Site\EmpreendimentoController@garagem');
	Route::get('/empreendimento/{id}/tour360', 'Site\EmpreendimentoController@tour360');
	Route::post('/planta/detalhe', 'Site\EmpreendimentoController@detalhePlanta');
	Route::get('/empreendimento/planta/{id}/unidades', 'Site\EmpreendimentoController@unidadesPlanta');

	Route::get('/proposta-online/{empreendimento}-{id}.html', 'Site\EmpreendimentoController@premium')->where([
		'empreendimento' => '(.*)',
		'id' => '([0-9]+)'
	]);

	// Termos de uso

	Route::get('termos-de-uso-lancamentos-online.html', 'Site\HomeController@termosUso');

	// Politica de privacidade

	Route::get('politica-de-privacidade-lancamentos-online.html', 'Site\HomeController@politicaPrivacidade');

	// Construtora

	Route::get('/construtora/{construtora}-{id}.html', 'Site\HomeController@construtora')->where([
		'construtora' => '(.*)',
		'id' => '([0-9]+)'
	]);

	// Newsletter

	Route::post('newsletter', 'Site\HomeController@newsletter');

	// Seja membro

	Route::get('seja-membro.html', 'Site\AssinaturaController@index');
	Route::post('assinar', 'Site\AssinaturaController@assinar');


	// Rotas mobile

	Route::get('/empreendimentos/{id}-{tipo}.html', 'Site\BuscaController@subtipo')->where([
		'tipo' => '(.*)',
		'id' => '([0-9]+)'
	]);

	// Rotas busca apartamentos mobile

	Route::get('/{subtipo}/{id}/em-obra', 'Site\BuscaController@modalidade')->where([
		'id' => '([0-9]+)',
		'subtipo' => '(.*)'
	]);

	Route::get('/{subtipo}/{id}/breve-lancamento', 'Site\BuscaController@modalidade')->where([
		'id' => '([0-9]+)',
		'subtipo' => '(.*)'
	]);

	Route::get('/{subtipo}/{id}/lancamento', 'Site\BuscaController@modalidade')->where([
		'id' => '([0-9]+)',
		'subtipo' => '(.*)'
	]);

	Route::get('/{subtipo}/{id}/mude-ja', 'Site\BuscaController@modalidade')->where([
		'id' => '([0-9]+)',
		'subtipo' => '(.*)'
	]);

	Route::get('/autocomplete', 'Site\BuscaController@autocomplete');

});

// Rotas para admin

Route::get('login', function () {
    return redirect('admin');
})->name('login');

Route::group(
[
    'namespace'  => 'Admin',
    'middleware' => 'web',
    'prefix'     => config('backpack.base.route_prefix'),
],
function () {
	Route::get('estatisticas', 'AdminController@dashboard')->name('backpack.dashboard');
	Route::get('dashboard', 'PerfilConstrutoraController@index')->name('perfil');
	Route::get('/', 'AdminController@redirect')->name('backpack');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Admin'], function () {

	// Leads

	Route::get('leads', 'LeadController@index')->name('leads');
	Route::get('leads/exportar', 'LeadController@exportarLeads')->name('exportar-leads');


	//Integrações

	Route::get('rede-domus', 'IntegracaoController@domus')->name('rede-domus');
	Route::get('facilita', 'IntegracaoController@facilita')->name('facilita');
	Route::get('anapro', 'IntegracaoController@anapro')->name('anapro');

	Route::post('integracao/atualizar-integracao-domus', 'IntegracaoController@atualizarIntegracaoDomus')->name('atualizar-integracao-domus');
	Route::post('integracao/integrar-usuario-domus', 'IntegracaoController@integrarUsuarioDomus')->name('integrar-usuario-domus');


	// Tabela Online
	Route::get('construtora/{id}/tabela-vendas', 'TabelaVendasController@index')->name('tabela-vendas');
	Route::get('construtora/{id}/negociar-unidades', 'TabelaVendasController@index')->name('negociar-unidades');
    Route::get('nova-tabela', 'TabelaVendasController@create')->name('nova-tabela');
	Route::post('gravar-tabela', 'TabelaVendasController@store')->name('gravar-tabela');
	Route::get('editar-tabela/{id}', 'TabelaVendasController@edit')->name('editar-tabela');
	Route::post('atualizar-tabela/{id}', 'TabelaVendasController@update')->name('atualizar-tabela');
	Route::post('gravar-tipo-tabela', 'TabelaVendasController@GravaTipoTabela')->name('gravar-tipo-tabela');
	Route::post('excluir-tabela/{id}', 'TabelaVendasController@destroy')->name('excluir-tabela');

	Route::post('buscar-torres-quadras-tabelas', 'TabelaVendasController@buscarTorresQuadrasTabela');
	Route::post('buscar-previsao-entrega', 'TabelaVendasController@buscarPrevisaoEntrega');

	// Oferta

	Route::get('ofertas', 'OfertaController@index');

	Route::get('ofertas/nova-oferta', 'OfertaController@novaOferta')->name('nova-oferta');

	Route::post('ofertas/cadastrar-oferta', 'OfertaController@cadastrarOferta')->name('cadastrar-oferta');

	Route::get('ofertas/alterar-oferta/{id}', 'OfertaController@alterarOferta')->name('alterar-oferta');

	Route::post('ofertas/atualizar-oferta/{id}', 'OfertaController@atualizarOferta')->name('atualizar-oferta');

	Route::post('ofertas/excluir-oferta/{id}', 'OfertaController@excluirOferta')->name('excluir-oferta');

	// Rotas auxiliares ofertas

	Route::post('ofertas/buscar-unidade/{id}', 'OfertaController@buscarUnidade');

	// Rotas auxiliares de ofertas verticais

	Route::post('buscar-torres-quadras-ofertas', 'TorreController@buscarTorresQuadrasOferta');

	Route::post('buscar-andares/{id}', 'TorreController@buscarAndares');

	Route::post('buscar-andares-2/{id}', 'TorreController@buscarAndares2');

	Route::post('buscar-unidades/{id}', 'TorreController@buscarUnidades');

	Route::post('buscar-plantas/{id}', 'TorreController@buscarPlantas');


	// Rotas auxiliares ofertas horizontais

	Route::post('buscar-unidades-horizontais/{id}', 'QuadraController@buscarUnidades');

	// Usuário

	CRUD::resource('user', 'UserCrudController');
	Route::get('user/{id}/restore', 'UserCrudController@restore')->name('restaurar-usuario');

	// Perfil Construtora

	Route::get('perfil-construtora', 'PerfilConstrutoraController@index')->name('perfil-construtora');

	Route::post('salvar-perfil-usuario', 'PerfilConstrutoraController@salvarPerfilUsuario');

	Route::post('salvar-senha-perfil', 'PerfilConstrutoraController@salvarSenha');

	Route::get('planos', 'PerfilConstrutoraController@planos')->name('planos');

	Route::get('construtora/{id}/alterar-plano', 'PerfilConstrutoraController@alterarPlano')->name('alterar-plano');

	Route::post('construtora/{id}/alterar-plano', 'PerfilConstrutoraController@atualizarPlano')->name('atualizar-plano');

	Route::post('salvar-redes-sociais-perfil', 'PerfilConstrutoraController@salvarRedesSociais');

	Route::post('salvar-canais-atendimento-perfil', 'PerfilConstrutoraController@salvarCanaisAtendimento');

	Route::post('salvar-endereco-construtora-perfil', 'PerfilConstrutoraController@salvarEnderecoConstrutora');

	Route::post('salvar-construtora-perfil', 'PerfilConstrutoraController@salvarConstrutora');

	Route::post('construtora/{id}/alterar-plano', 'PerfilConstrutoraController@atualizarPlano')->name('atualizar-plano');

	Route::get('construtora/{id}/novo-membro', 'PerfilConstrutoraController@novoMembro')->name('novo-membro');

	Route::post('construtora/{id}/novo-membro', 'PerfilConstrutoraController@cadastrarMembro')->name('cadastrar-membro');

	Route::get('construtora/{id}/alterar-membro', 'PerfilConstrutoraController@alterarMembro')->name('alterar-membro');

	Route::post('construtora/{id}/atualizar-membro', 'PerfilConstrutoraController@atualizarMembro')->name('atualizar-membro');

	Route::post('construtora/{id}/excluir-membro', 'PerfilConstrutoraController@excluirMembro')->name('excluir-membro');

	// Perfil Usuário

	Route::get('perfil-usuario', 'PerfilUsuarioController@index')->name('perfil-usuario');

	// Publicações
	Route::get('publicacoes', 'PublicacaoController@index')->name('publicacoes');
	Route::get('publicacoes/adicionar', 'PublicacaoController@create')->name('publicacoes.adicionar');
	Route::post('publicacao/salvar', 'PublicacaoController@store');
	Route::get('publicacao/{id}/editar', 'PublicacaoController@edit')->name('app.publicacao.editar');
	Route::post('publicacao/update', 'PublicacaoController@update');
	Route::get('publicacao/{id}/excluir', 'PublicacaoController@destroy')->name('app.publicacao.editar');


	// Empreendimento

	Route::get('empreendimentos', 'EmpreendimentoController@index')->name('empreendimentos');

	Route::get('empreendimento', 'EmpreendimentoController@cadastrar')->name('empreendimento.criar');

	Route::get('empreendimento/{id}/editar', 'EmpreendimentoController@editar')->name('empreendimento.editar');

	Route::get('empreendimento/{id}/visualizar', 'EmpreendimentoController@view')->name('empreendimento.visualizar');

	Route::post('salvar-dados-empreendimento', 'EmpreendimentoController@salvarDadosEmpreendimento')->name('empreendimento.registrar');

	Route::post('salvar-endereco-empreendimento', 'EmpreendimentoController@salvarEnderecoEmpreendimento');

	Route::post('salvar-endereco-stand', 'EmpreendimentoController@salvarEnderecoStand');

	Route::post('salvar-itens-lazer-empreendimento', 'EmpreendimentoController@salvarItensLazerEmpreendimento');

	Route::post('salvar-caracteristicas-empreendimento', 'EmpreendimentoController@salvarCaracteristicasEmpreendimento');

	Route::post('salvar-midias-empreendimento', 'EmpreendimentoController@salvarMidiasEmpreendimento');

	Route::post('salvar-honorarios-intermediacao', 'EmpreendimentoController@salvarHonorariosIntermediacao');

	Route::post('salvar-arquivos-empreendimento', 'EmpreendimentoController@salvarArquivosEmpreendimento');

	Route::post('salvar-arquivos-empreendimento', 'EmpreendimentoController@salvarArquivosEmpreendimento');

	Route::post('gerar-torres-unidades', 'EmpreendimentoController@gerarTorresUnidades');

	Route::post('gerar-quadras-unidades', 'EmpreendimentoController@gerarQuadrasUnidades');

	Route::post('salvar-fotos-empreendimento', 'EmpreendimentoController@salvarFotosEmpreendimento')->name('upload_fotos');

	Route::post('excluir-empreendimento', 'EmpreendimentoController@excluirEmpreendimento');

	Route::get('empreendimento/{id}/mapa', 'EmpreendimentoController@mapa')->name('empreendimento.mapa');

	Route::get('empreendimento/{id}/mapa-lazer', 'EmpreendimentoController@mapaLazer')->name('empreendimento.mapa-lazer');

	Route::get('empreendimento/{id}/mapa-vertical/{view}', 'EmpreendimentoController@mapaVertical')->name('empreendimento.mapa-vertical');

	Route::get('empreendimento/{id}/mapa-garagens', 'EmpreendimentoController@mapaGaragens')->name('empreendimento.mapa-garagens');

	Route::post('empreendimento/salvar-seo', 'EmpreendimentoController@salvarSeo');

	Route::post('empreendimento/salvar-tour', 'EmpreendimentoController@salvarTour');

	// Rotas Atualizações
	Route::get('empreendimento/{id}/atualiza-garagens', 'EmpreendimentoController@atualizarGaragensEmpreendimento')->name('empreendimento.atualiza-garagens');

	// Empreendimento rotas auxiliares

	Route::post('filtrar-empreendimento', 'EmpreendimentoController@filtrarEmpreendimentos');

	Route::post('buscar-cidade-perfil', 'CidadeController@buscarCidadePerfil');

	Route::post('buscar-bairro-perfil', 'CidadeController@buscarBairroPerfil');

	Route::post('buscar-cidade', 'CidadeController@buscarCidade');

    Route::post('buscar-cidade-stand', 'CidadeController@buscarCidadeStand');

	Route::post('buscar-bairro', 'CidadeController@buscarBairro');

	Route::post('buscar-bairro-comercial', 'CidadeController@buscarBairroComercial');

	Route::post('buscar-torre', 'TorreController@buscarTorre');

	Route::post('buscar-subtipo-empreendimento', 'TipoEmpreendimentoController@buscarSubtipo');

	Route::post('buscar-variacao-empreendimento', 'TipoEmpreendimentoController@buscarVariacao');

	Route::post('trocar-construtora', 'EmpreendimentoController@trocarConstrutora');

	Route::post('buscar-cep', 'EmpreendimentoController@buscarCep');

	Route::post('buscar-unidades-torre', 'TorreController@buscarUnidades2');

	Route::post('buscar-unidades-quadra', 'QuadraController@buscarUnidades2');

	Route::post('buscar-unidades-torre-vendidas', 'TorreController@buscarUnidadesVendidas');

	Route::post('buscar-unidades-quadra-vendidas', 'QuadraController@buscarUnidadesVendidas');

	// Fotos

	Route::get('empreendimento/{id}/fotos', 'EmpreendimentoController@indexFotosEmpreendimento')->name('fotos-empreendimento');

	Route::get('empreendimento/{id}/alterar-foto', 'EmpreendimentoController@alterarFoto')->name('alterar-foto');

	Route::post('empreendimento/{id}/atualizar-foto', 'EmpreendimentoController@atualizarFoto')->name('atualizar-foto');

	Route::post('empreendimento/excluir-foto', 'EmpreendimentoController@excluirFoto')->name('excluir-fotos');

	Route::post('empreendimento/destacar-foto-principal', 'EmpreendimentoController@destacarFotoPrincipal')->name('destacar-foto-principal');

	Route::post('empreendimento/destacar-foto-carrossel', 'EmpreendimentoController@destacarFotoCarrossel')->name('destacar-foto-carrossel');

	Route::post('empreendimento/foto/remover-destaque', 'EmpreendimentoController@removerDestaquePrincipal')->name('remover-destaque-principal');

	Route::post('empreendimento/foto/remover-destaque-carrossel', 'EmpreendimentoController@removerDestaqueCarrossel')->name('remover-destaque-carrossel');

	// Plantas

	Route::get('empreendimento/{id}/plantas', 'EmpreendimentoController@indexPlantas')->name('plantas');

	Route::get('empreendimento/{id}/cadastrar-planta', 'EmpreendimentoController@cadastrarPlanta')->name('cadastrar-planta');

	Route::get('empreendimento/{id}/alterar-planta', 'EmpreendimentoController@alterarPlanta')->name('alterar-planta');

	Route::post('cadastrar-planta', 'EmpreendimentoController@salvarPlanta');

	Route::post('atualizar-planta', 'EmpreendimentoController@atualizarPlanta');

	Route::post('excluir-planta', 'EmpreendimentoController@excluirPlanta');

	// Torres

	Route::get('empreendimento/{id}/torres', 'EmpreendimentoController@indexTorres')->name('torres');

	Route::get('empreendimento/{id}/cadastrar-torre', 'EmpreendimentoController@cadastrarTorre')->name('cadastrar-torre');

	Route::get('empreendimento/{id}/alterar-torre', 'EmpreendimentoController@alterarTorre')->name('alterar-torre');

	Route::post('cadastrar-torre', 'EmpreendimentoController@salvarTorre');

	Route::post('atualizar-torre', 'EmpreendimentoController@atualizarTorre');

	Route::post('excluir-torre', 'EmpreendimentoController@excluirTorre');

	Route::post('excluir-torres-unidades', 'EmpreendimentoController@excluirTorresUnidades');

	// Quadras

	Route::get('empreendimento/{id}/quadras', 'EmpreendimentoController@indexQuadras')->name('quadras');

	Route::get('empreendimento/{id}/cadastrar-Quadra', 'EmpreendimentoController@cadastrarQuadra')->name('cadastrar-quadra');

	Route::get('empreendimento/{id}/alterar-quadra', 'EmpreendimentoController@alterarQuadra')->name('alterar-quadra');

	Route::post('cadastrar-quadra', 'EmpreendimentoController@salvarQuadra');

	Route::post('atualizar-quadra', 'EmpreendimentoController@atualizarQuadra');

	Route::post('excluir-quadra', 'EmpreendimentoController@excluirQuadra');

	Route::post('excluir-quadras-unidades', 'EmpreendimentoController@excluirQuadrasUnidades');

	// Unidades

	Route::get('empreendimento/{id}/unidades', 'EmpreendimentoController@indexUnidades')->name('unidades');

	Route::post('empreendimento/{id}/atualizar-situacao-unidade', 'EmpreendimentoController@atualizarSituacaoUnidade')->name('alterar-situacao-unidade');

	Route::get('empreendimento/{id}/alterar-unidade', 'EmpreendimentoController@alterarUnidade')->name('alterar-unidade');

	Route::get('empreendimento/{id}/info-unidade', 'EmpreendimentoController@infoUnidade')->name('info-unidade');

	Route::post('empreendimento/{id}/atualizar-unidade', 'EmpreendimentoController@atualizarUnidade')->name('atualizar-unidade');

	Route::get('empreendimento/{id}/alterar-venda-unidade', 'EmpreendimentoController@alterarVendaUnidade')->name('alterar-venda-unidade');

	Route::post('empreendimento/{id}/atualizar-venda-unidade', 'EmpreendimentoController@atualizarVendaUnidade')->name('atualizar-venda-unidade');

	Route::get('empreendimento/{id}/alterar-reserva-unidade', 'EmpreendimentoController@alterarReservaUnidade')->name('alterar-reserva-unidade');

	Route::post('empreendimento/{id}/atualizar-reserva-unidade', 'EmpreendimentoController@atualizarReservaUnidade')->name('atualizar-reserva-unidade');


	Route::post('empreendimento/filtrar-unidades', 'EmpreendimentoController@filtrarUnidades');

	Route::post('empreendimento/unidade/atualizar-coordenadas', 'EmpreendimentoController@atualizarCoordenadasUnidade');

	Route::post('empreendimento/garagem/atualizar-coordenadas', 'EmpreendimentoController@atualizarCoordenadasVaga');

	Route::post('empreendimento/foto/atualizar-coordenadas', 'EmpreendimentoController@atualizarCoordenadasFoto');

	Route::post('empreendimento/alteracoes-em-lote', 'EmpreendimentoController@alteracoesEmLote');

	Route::get('empreendimento/{id}/unidades/historico', 'EmpreendimentoController@historicoUnidades')->name('historico-unidades');

	// Pavimentos Garagens

	Route::get('empreendimento/{id}/pavimentos', 'EmpreendimentoController@indexPavimentos')->name('pavimentos');

	Route::get('empreendimento/{id}/cadastrar-pavimento', 'EmpreendimentoController@cadastrarPavimento')->name('cadastrar-pavimento');

	Route::get('empreendimento/{id}/alterar-pavimento', 'EmpreendimentoController@alterarPavimento')->name('alterar-pavimento');

	Route::post('cadastrar-pavimento', 'EmpreendimentoController@salvarPavimento');

	Route::post('atualizar-pavimento', 'EmpreendimentoController@atualizarPavimento');

	Route::post('excluir-pavimento', 'EmpreendimentoController@excluirPavimento');

	// Garagens

	Route::get('empreendimento/{id}/garagens', 'EmpreendimentoController@indexGaragens')->name('garagens');

	Route::post('empreendimento/{id}/atualizar-situacao-garagem', 'EmpreendimentoController@atualizarSituacaoGaragem')->name('alterar-situacao-garagem');

	Route::get('empreendimento/{id}/alterar-garagem', 'EmpreendimentoController@alterarGaragem')->name('alterar-garagem');

	Route::post('empreendimento/{id}/atualizar-garagem', 'EmpreendimentoController@atualizarGaragem')->name('atualizar-garagem');

	Route::get('empreendimento/{id}/alterar-venda-garagem', 'EmpreendimentoController@alterarVendaGaragem')->name('alterar-venda-garagem');

	Route::post('empreendimento/{id}/atualizar-venda-garagem', 'EmpreendimentoController@atualizarVendaGaragem')->name('atualizar-venda-garagem');

	Route::post('empreendimento/filtrar-garagens', 'EmpreendimentoController@filtrarGaragens');

	// Financeiro

	Route::get('construtora/{id}/financeiro', 'FinanceiroController@index')->name('financeiro-construtora');
	Route::get('construtora/{id}/meu-plano', 'FinanceiroController@meuPlano')->name('meu-plano');
	Route::post('construtora/financeiro/criar-lancamento-financeiro', 'FinanceiroController@criarLancamentoFinanceiro')->name('criar-lancamento-financeiro');
	Route::post('construtora/financeiro/cancelar-lancamento-financeiro/{id}', 'FinanceiroController@cancelarLancamentoFinanceiro')->name('cancelar-lancamento-financeiro');
	Route::post('construtora/financeiro/reenviar-por-email/{id}', 'FinanceiroController@reenviarPorEmail')->name('reenviar-lancamento-email');
});

Route::group(['middleware' => ['web'], 'namespace' => 'Admin'], function () {

	Route::get('empreendimento/{id}/{hash}/visualizar-mapa/{view}', 'EmpreendimentoController@visualizarMapa');
	Route::get('empreendimento/{id}/{hash}/visualizar-mapa-vertical/{view}', 'EmpreendimentoController@visualizarMapaVertical');
	Route::get('empreendimento/{id}/{hash}/visualizar-mapa-lazer/{view}', 'EmpreendimentoController@visualizarMapaLazer');
	Route::get('empreendimento/{id}/{hash}/gerar-pdf-mapa/{url}', 'EmpreendimentoController@gerarPdfMapa');
	Route::get('empreendimento/{id}/{acao}/download-pdf', 'EmpreendimentoController@downloadPdfMapa');
	Route::get('empreendimento/{id}/unidades/imprimir-disponibilidade', 'EmpreendimentoController@imprimirDisponibilidade')->name('imprimir-disponibilidade');
	Route::get('empreendimento/{id}/unidades/imprimir-disponibilidade/pdf', 'EmpreendimentoController@gerarPdfDisponibilidade')->name('imprimir-disponibilidade-pdf');


	Route::get('unidade/{id}/{hash}/visualizar-mapa/{view}', 'EmpreendimentoController@visualizarUnidadeMapa');
	Route::get('unidade/{id}/{hash}/visualizar-mapa-vertical/{view}', 'EmpreendimentoController@visualizarUnidadeMapaVertical');

	Route::get('unidade/{id}/geraImagemMapa','EmpreendimentoController@geraImagemMapa');

	Route::get('empreendimento/{id}/{hash}/visualizar-garagens/{view}', 'EmpreendimentoController@visualizarGaragens');


	Route::get('empreendimento/{id}/{hash}/view-mapa/{view}', 'EmpreendimentoController@viewMapa');
});

Route::post('retorno-safepay', 'Admin\FinanceiroController@retornoSafePay');

Route::get('formatar-valor-reais/{valor}', function ($valor) {

	if (!$valor or $valor == "NaN" or $valor == "undefined") {
		$retorno =  '0.00';
	} else {

		$retorno = number_format($valor, 2,',', '.');
	}

	return response()->json([
		'retorno' => $retorno
	]);
});

Route::get('user-restore/{id}', function ($id) {
	$user = Usuario::withTrashed()->findOrFail($id);
	$user->restore();
});

Route::get('empreendimento-restore/{id}', function ($id) {
	$empreendimento = Empreendimento::withTrashed()->findOrFail($id);
	$empreendimento->restore();
});

//Atualiza Resumo
Route::get('resumo-estatistica/{tipo}/{mes}/{ano}', 'Admin\EstatisticaController@atualizaResumo');

// testa integração
Route::get('integracao-mrv', 'Admin\LeadController@integracaoMrvHom');
Route::get('integracao-mrv-new', 'Admin\LeadController@integracaoMrvNew');
Route::get('atualiza-reservas', 'Admin\CronController@BaixaReserva');
Route::get('testar-envio/{lead}', 'Admin\LeadController@TestarEnvio');
Route::get('reenviar-leads', 'Admin\LeadController@ReenviarLeads');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/atualizar-caracteristicas/{id}', function($id) {
    $unidades = Unidade::where('empreendimento_id', $id)->get();

    foreach($unidades as $unidade){

		if($id == 337){
			DB::table('caracteristicas_unidades')->insert([
				['caracteristica_id' => 588, 'unidade_id' => $unidade->id, 'valor' => '10,00'],
				['caracteristica_id' => 589, 'unidade_id' => $unidade->id, 'valor' => '10,00'],
				['caracteristica_id' => 590, 'unidade_id' => $unidade->id, 'valor' => '22,79'],
				['caracteristica_id' => 591, 'unidade_id' => $unidade->id, 'valor' => '22,79']
			]);
		}

		if($id == 343){
			DB::table('caracteristicas_unidades')->insert([
				['caracteristica_id' => 588, 'unidade_id' => $unidade->id, 'valor' => '12,00'],
				['caracteristica_id' => 589, 'unidade_id' => $unidade->id, 'valor' => '12,00'],
				['caracteristica_id' => 590, 'unidade_id' => $unidade->id, 'valor' => '25,00'],
				['caracteristica_id' => 591, 'unidade_id' => $unidade->id, 'valor' => '25,00']
			]);
		}

    }
});

Route::get('/deleta-caracteristicas/{id}', function($id) {
    $unidades = Unidade::where('empreendimento_id', $id)->get();

    foreach($unidades as $unidade){

		DB::table('caracteristicas_unidades')->where('caracteristica_id',588)->where('unidade_id',$unidade->id)->delete();
		DB::table('caracteristicas_unidades')->where('caracteristica_id',589)->where('unidade_id',$unidade->id)->delete();
		DB::table('caracteristicas_unidades')->where('caracteristica_id',590)->where('unidade_id',$unidade->id)->delete();
		DB::table('caracteristicas_unidades')->where('caracteristica_id',591)->where('unidade_id',$unidade->id)->delete();

    }
});

/*SITE 2023*/
Route::any('busca-mapa.html', 'Site\BuscaController@index');
Route::get('resultado-busca.html', 'Site\HomeController@Busca');
Route::get('index.html', 'Site\HomeController@NovaIndex');
Route::get('painel-anunciante.html', 'Admin\AdminController@dashboard');

/* Rotas Corretor */
Route::get('/home-corretor', 'Corretor\AuthController@home')->name('home-corretor');
Route::post('/corretor/login', 'Corretor\AuthController@Login')->name('login-corretor');
Route::post('/corretor/salvar', 'Corretor\CorretorController@store')->name('corretor.salvar');
Route::post('/corretor/reenviar-senha', 'Corretor\AuthController@ReenviarSenha')->name('corretor.reenviar-senha');
Route::get('/corretor/lembrar-senha', 'Corretor\AuthController@LembrarSenha')->name('corretor.lembrar-senha');
Route::get('/corretor/cadastro', 'Corretor\HomeController@cadastro')->name('corretor.cadastro');
Route::get('/login', 'Corretor\HomeController@login')->name('login');
Route::get('/corretor/empreendimentos', 'Corretor\HomeController@ListaEmpreendimentos')->name('corretor.empreendimentos');
Route::get('/corretor/empreendimento/{id}', 'Corretor\HomeController@EmpreendimentoDetalhes')->name('corretor.empreendimento.detalhes');
Route::get('/corretor/propostas', 'Corretor\HomeController@ListaPropostas')->name('corretor.propostas');
Route::get('/corretor/proposta/{id}', 'Corretor\HomeController@Proposta')->name('corretor.proposta.detalhes');
Route::get('/corretor/perfil', 'Corretor\HomeController@Perfil')->name('corretor.perfil');
Route::get('/corretor/leads', 'Corretor\HomeController@Leads')->name('corretor.leads');
Route::get('/corretor/logout', 'Corretor\AuthController@Logout')->name('corretor.logout');
Route::post('/corretor/update', 'Corretor\CorretorController@update')->name('corretor.update');
Route::get('/corretor/usuario/{id}/foto', 'Corretor\UserController@getFoto')->name('corretor.usuario.foto');
