@extends('site/layout');

@push('css')
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">
<!-- Font awesome styles -->    
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
<!-- Custom styles -->
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700,700italic&amp;subset=latin,latin-ext'>
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css">
<link rel="stylesheet" type="text/css" href="/site/css/busca.css">
<link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">
@endpush

@push('js_header')
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
@endpush

@push('js_footer')
<script>
  $(function () {
    $(".loader-bg").fadeOut('slow');
  });
</script>
@endpush

@section('content')
<section class="section-light section-top-shadow no-bottom-padding">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            
            <div class="row margin-top-60">
              
              <div class="col-xs-12 col-sm-6 col-lg-12 politica">
                
                
                <h3>TERMOS E USO</h3>
                <p>PORTAL: MIO SERVIÇOS DIGITAIS E TECNOLOGICOS LTDA inscrita no CNPJ N° 13.335.397/0001-14, é a empresa proprietária do denominado https://www.lancamentosonline.com.br.</p>
                <p>USUÁRIO(S): são as pessoas que acessam ao lancamentosonline.com.br podendo criar ou não conta para navegar e desfrutar de todas as ferramentas disponíveis no portal.</p>
                <p>PARCEIRO(S): são as Construtoras e Incorporadoras membros do site que publicam seus lançamentos imobiliários à venda no lancamentosonline.com.br.</p>
                <p>Este documento visa informar a responsabilidade, deveres e obrigações que todo USUÁRIO assume ao acessar o Lancamentosonline.com.br.</p>
                <p>O USUÁRIO deve ler com atenção os termos abaixo antes de acessar, criar conta ou usar o Lancamentosonline.com.br, pois o acesso ou uso deste implica em concordância com tais termos. O PORTAL e seus PARCEIROS somente fornecerão ao USUÁRIO informações e serviços mediante expressa concordância aos termos, condições e informações aqui contidas, assim como aos demais documentos incorporados ao mesmo por referência. </p>
                <p>O uso do Lancamentosonline.com.br significa a total concordância com tais termos, condições e informações.
                  O Lancamentosonline.com atua como facilitador de negócios de lancamentos imobiliários publicados através de diversos PARCEIRO(S) e, portanto, não atua como prestador de serviços de consultoria ou ainda intermediário ou participante em nenhum negócio entre o USUÁRIO e o(s)PARCEIRO(S).
                  Dessa forma, o PORTAL não assume responsabilidade por nenhuma consequência que possa advir de qualquer relação entre o USUÁRIO e o(s) PARCEIRO(S), seja ela direta ou indireta. Assim, o PORTAL não é responsável por qualquer ação ou omissão do USUÁRIO baseada nas informações, anúncios, fotos, vídeos ou outros materiais publicados no Lancamentosonline.com.br. Adicionalmente, o PORTAL envida seus melhores esforços para manter o Lancamentosonline.com.br sempre atualizado, preciso e completo, mas não se responsabiliza por imprecisão, erro, fraude, inexatidão ou divergência nos dados, fotos e vídeos ou outros materiais relacionados a anúncios ou à imprecisão das informações aqui contidas.
                  Por isto, nos casos em que um ou mais USUÁRIOS ou algum terceiro inicie qualquer tipo de reclamação ou ação legal contra um ou mais PARCEIRO(S), todos os envolvidos nas reclamações ou ações devem eximir de toda responsabilidade o PORTAL e seus funcionários, agentes, operários, representantes e procuradores. O PORTAL também não se responsabiliza pelas obrigações tributárias que recaiam nas atividades entre USUÁRIO e PARCEIRO(S) do Lancamentosonline.com.br. Assim, ao iniciar qualquer processo de aquisição de algum bem, o USUÁRIO deverá exigir nota fiscal do(s) PARCEIRO(S), a menos que este esteja legalmente dispensado de fornecê-la.</p>
                  <p>O PORTAL expressamente sugere que o USUÁRIO: (I) verifique cautelosamente toda a documentação e/ou características de qualquer dos produtos ou serviços ofertados antes da conclusão de qualquer negócio, concordando que ao negociar com o(s) PARCEIRO(S) dos produtos e serviços ofertados o faz por sua conta e risco; (II) verifique pessoalmente ou através de alguém de sua confiança qualquer bem ou serviço a ser adquirido; (III) seja cuidadoso com os dados de sua identificação individual sempre que acessar a Internet, informando-os apenas em operações em que exista a proteção de dados; (IV) forneça informações verídicas e de sua titularidade; (V) seja responsável por qualquer tipo de informação ou afirmação originadas com seu nome de USUÁRIO e senha; (VI) mantenha em sigilo a sua identificação de USUÁRIO(nome e senha); (VII) desconecte sua conta do Lancamentosonline.com.br tão logo deixe de acessá-lo, principalmente se dividir o computador com outra pessoa; (VIII) cumpra rigorosamente todas as determinações deste Termo de Uso; (IX) tome quaisquer outras medidas necessárias para se proteger de danos, inclusive fraudes ou estelionato "on line".</p>
                  
                  <p>Por meio deste Termo de Uso, o USUÁRIO aceita ser identificado pelo sistema do Lancamentosonline.com.br, através, por exemplo, do uso de "cookies" ou outras tecnologias. Tal política visa à melhoria contínua dos serviços prestados pelo Lancamentosonline.com.br. Mais informações podem ser obtidas através da Política de Privacidade do Lancamentosonline.com.br</p>
                  <p>Caso o USUÁRIO acesse ao(s) produto(s) de PARCEIRO(S), é possível que haja solicitação de informações financeiras e/ou pessoais suas. Tais informações não estarão sendo enviadas pelo USUÁRIO ao Lancamentosonline.com.br, e sim diretamente ao solicitante, não tendo o PORTAL, portanto, qualquer responsabilidade pela utilização e manejo dessa informação.</p>
                  <p>O PORTAL toma os cuidados necessários para evitar o envio não solicitado de e-mails. Por isso fica estabelecido que é absolutamente proibida a utilização da ferramenta: "Enviar para amigos" com a finalidade de Spam, ou envio indiscriminado de mensagens de qualquer natureza via correio eletrônico.</p>
                  <p>O PORTAL poderá suspender, inabilitar definitivamente e aplicar as medidas jurídicas cabíveis aos USUÁRIOS que utilizarem esta ferramenta com a finalidade de promover seus produtos ou serviços à venda ou com qualquer outro fim, e que forem denunciados pelas pessoas que receberam essas mensagens. Para fins de obtenção de informações sobre uma publicação, o USUÁRIO do Lancamentosonline.com.br não terá que desembolsar qualquer taxa para o(s) PARCEIRO(S), a qualquer título que seja. Qualquer infração nesse sentido por parte de PARCEIRO(S) deve ser notificada imediatamente ao PORTAL.</p>
                  
                  <h3>CADASTRO</h3>
                  <p>O Lancamentosonline.com.br oferece a possibilidade do USUÁRIO se cadastrar, e neste caso tal USUÁRIO pode ter acesso a informações, recursos ou facilidades exclusivas, responsabilizando-se o USUÁRIO civil e criminalmente pelas informações e dados fornecidos. O cadastro é gratuito e sujeito à análise, tanto para o USUÁRIO quanto para o(s) PARCEIRO(S).</p>
                  <p>Não é permitido que um mesmo USUÁRIO tenha mais de um cadastro. Se o Lancamentosonline.com.br detectar cadastros que aparentemente pertencem à mesma pessoa, poderá inabilitar definitivamente todos os cadastros.</p>
                  <p>O Lancamentosonline.com.br se reserva o direito de recusar qualquer solicitação de cadastro e de cancelar um cadastro previamente aceito, a seu exclusivo critério e sem aviso prévio, não cabendo nenhuma indenização ou reparação pelo cancelamento de quaisquer cadastros ou de impossibilidade de cadastro. A comunicação via Internet, entre o USUÁRIO interessado em adquirir um bem ou serviço de empreendimento publicado no Lancamentosonline.com.br e o(s) PARCEIRO(S) devem ser efetuados por uma ferramenta de envio e recebimento de mensagens desenvolvido pelo Lancamentosonline.com.br. Todas as mensagens trocadas entre o USUÁRIO interessado e o(s) PARCEIRO(S) ficarão armazenadas nos sistemas do Lancamentosonline.com.br por 30 dias, a partir da última mensagem trocada entre as partes.</p>									
                  
                  <h3>LIMITAÇÃO DE USO</h3>
                  <p>O USUÁRIO poderá acessar, utilizar e imprimir materiais deste portal para seu uso pessoal e não-comercial. O USUÁRIO não poderá copiar, distribuir, transmitir, exibir, reproduzir, modificar, publicar, licenciar, criar trabalho derivado, colocar e/ou usar em outra página da Internet, transferir ou vender qualquer informação, "software", lista de USUÁRIO(S) e outras listas, produtos ou serviços obtidos no Lancamentosonline.com.br, para uso comercial. Esta proibição expressamente inclui, mas não se limita, à prática de "screen scraping" ou "database scraping" para obter listas de USUÁRIOS ou outras informações para uso comercial ou não.
                    A título meramente exemplificativo, o USUÁRIO não poderá: (1) utilizar os produtos e/ou serviços disponíveis no Lancamentosonline.com.br para fins diversos daqueles a que se destinam; (2) enviar ou transmitir quaisquer tipos de informações que induzam, incitem ou resultem em atitudes discriminatórias, mensagens violentas ou delituosas que atentem contra a moral e bons costumes e que contrariam a ordem pública; (3) utilizar os dados para contato de PARCEIROS(S) com outro propósito que não seja o de encaminhar formulário para tirar dúvidas, agendar visita, solicitar condições de pagamento ou proposta comercial; (4) cadastrar-se com informações falsas ou de propriedade de terceiros; (5) enviar ou transmitir qualquer tipo de informação que seja de propriedade de terceiros; (6) alterar, apagar ou corromper dados e informações de terceiros; (7) violar a privacidade de outros USUÁRIOS; (8) enviar ou transmitir arquivos com vírus de computador, com conteúdo destrutivo, invasivo ou que causem dano permanente ou temporário aos equipamentos do destinatário e/ou do Lancamentosonline.com.br ou ao portal do Lancamentosonline.com.br; (9) utilizar endereços de computadores, de rede ou de correio eletrônico falsos; (10) violar propriedade intelectual (direito autoral, marca, patente etc) de terceiros, por meio de qualquer tipo de reprodução de material, sem a prévia autorização do proprietário; (11) fazer a distribuição de cópias do Lancamentosonline.com.br; (12) utilizar de qualquer forma trechos, técnica de engenharia reversa no desenvolvimento ou criação de outros trabalhos a fim de se analisar sua constituição; (13) utilizar apelido que guarde semelhança com o nome "Lancamentos Online"; (14) utilizar qualquer apelido que insinue ou sugira que os produtos ou serviços anunciados pertencem ao Lancamentosonline.com.br ou que fazem parte de promoções suas; e (15) utilizar apelidos considerados ofensivos, bem como os que contenham dados pessoais do USUÁRIO ou alguma URL ou endereço eletrônico.
                    A inobservância das condições, dos termos e das observações de uso deste PORTAL ensejará notificação do USUÁRIO, bem como o cancelamento ou suspensão de seu cadastro, temporariamente ou de modo definitivo, sem prejuízo das cominações legais pertinentes.</p>
                    <h3>PROPRIEDADE INTELECTUAL, DIREITOS AUTORAIS E MARCAS</h3>
                    <p>Todo o material do Lancamentos Online (a sua apresentação e "layout", marcas, logotipos, produtos, sistemas, denominações de serviços e outros materiais), incluindo programas, bases de dados, imagens, arquivos ou materiais de qualquer outra espécie e que têm contratualmente autorizadas as suas inserções neste portal, é protegido pela legislação de Propriedade Intelectual, sendo de titularidade do PORTAL e PARCEIROS. A reprodução, distribuição e transmissão de tais materiais não são permitidas sem o expresso consentimento por escrito do PORTAL ou do respectivo PARCEIRO, especialmente para fim comercial ou econômico.</p>
                    <p>O uso indevido de materiais protegidos por propriedade intelectual (direito autoral, marcas comerciais, patentes etc.) apresentados no Lancamentosonline.com.br será caracterizado como infração da legislação pertinente, sujeitando o infrator às ações judiciais cabíveis e dando ensejo à respectiva indenização aos prejudicados, seja ao PORTAL, seja a terceiros, sem prejuízo de perdas e danos e honorários advocatícios.</p>
                    <h3>RISCOS TECNOLÓGICOS</h3>
                    <p>Todos os riscos derivados da utilização do Lancamentosonline.com.br são do USUÁRIO. Se o seu uso resultar na necessidade de serviços ou reposição de material, propriedade, equipamento ou informação do USUÁRIO, o PORTAL e seus PARCEIROS não serão responsáveis por tais custos. As informações, "software", produtos, valores e serviços publicados neste portal podem conter erros tipográficos ou imprecisões. Alterações e ajustes das informações são realizados periodicamente. Em nenhum caso o PORTAL será responsabilizado por qualquer dano direto, indireto, incidental, especial ou como consequência de quaisquer fatos resultantes do uso do portal ou da inabilidade de uso deste, ou ainda por quaisquer informações, produtos ou serviços obtidos através dele ou em decorrência do seu uso.</p>
                    <h3>LINKS PARA "SITES" DE TERCEIROS</h3>
                    <p>Este portal pode conter "hyperlinks" para outros portais operados por terceiros que não o Lancamentosonline.com.br. Esses "hyperlinks" são fornecidos para sua referência apenas. O PORTAL não tem controle sobre esses outros portais, e não se responsabiliza pelo conteúdo dos mesmos. A inclusão desses "hyperlinks" não implica na aprovação do material ou qualquer associação com seus operadores. Ao acessar e usar esses outros portais - incluindo as informações, materiais, produtos e serviços dos mesmos -, o USUÁRIO estará fazendo-o por sua conta e risco. As mesmas regram se aplicam aos outros portais que contenham "hyperlinks" para o PORTAL, pois o PORTAL também não tem controle sobre estes. A Política de Privacidade do Lancamentosonline.com.br é aplicável apenas quando o USUÁRIO está acessando e usando o Lancamentosonline.com.br; uma vez encaminhado a outro portal, o USUÁRIO estará sujeito às políticas desse outro portal, sobre a qual o PORTAL não tem qualquer controle ou relação.</p>
                    <h3>MUDANÇAS NO PORTAL</h3>
                    <p>O PORTAL e seus PARCEIROS poderão fazer mudanças nas informações, serviços, produtos e outros materiais do portal, ou ainda encerrar as atividades, a qualquer momento sem nenhuma notificação prévia ao USUÁRIO e sem possibilidade de indenização a qualquer USUÁRIO.</p>
                    <h3>ALTERAÇÃO DOS TERMOS DE USO</h3>
                    <p>O PORTAL poderá modificar, alterar e/ou ajustar estes termos a qualquer tempo e essas modificações, alterações e/ou ajustes deverão ser efetivos e imediatos assim que estes se tornem públicos. Para este efeito, o USUÁRIO deverá rever os termos de uso periodicamente, sendo certo que o acesso ou uso contínuo do Lancamentosonline.com.br pelo USUÁRIO subordina-se à aceitação dos termos em vigor.</p>
                    <h3>INDENIZAÇÃO</h3>
                    <p>O USUÁRIO indenizará o PORTAL e PARCEIROS por qualquer demanda promovida por outros USUÁRIOS ou terceiros decorrentes de suas atividades ilegais no Lancamentosonline.com.br ou por seu descumprimento dos Termos de Uso e demais políticas do Lancamentosonline.com.br, ou pela violação de qualquer lei ou direitos de terceiros, sendo de responsabilidade do USUÁRIO a reparação por perdas e danos, mais honorários de advogados.</p>
                  </div>
                </div>
                
                
              </div>
            </div>
            
            
            
          </div>
          
        </div>
      </div>
    </section>
    <div class="row margin-top-60"></div>
    @endsection