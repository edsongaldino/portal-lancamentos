<div class="panel panel-accordion panel-accordion-seo">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Six">
        <i class="fa fa-google-plus"></i> SEO - Marketing
      </a>
    </h4>
  </div>
  <div id="collapse2Six" class="accordion-body collapse">
    <div class="panel-body">
      <form id="seo-empreendimento" class="form-horizontal form-bordered" method="post">
        @if (isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif

        <div class="form-group">
          <div class="col-md-12">

            <div class="form-group">
              <label class="col-md-2 control-label">Título da Página</label>
              <div class="col-md-10">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-text-width"></i>
                  </span>
                  <input name="titulo" value="@if(isset($entry->seo)){{ $entry->seo->titulo }}@endif" id="titulo" type="text" placeholder="Título do Empreendimento" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">TAG < description ></label>
              <div class="col-md-10">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-indent"></i>
                  </span>                                            
                  <textarea name="descricao" class="form-control descricao" rows="5" id="textareaAutosize" data-plugin-textarea-autosize>@if(isset($entry->seo)){!! strip_tags($entry->seo->descricao) !!}@endif</textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">TAG < <b>H1</b> ></label>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-rocket"></i>
                  </span>                                            
                  <input name="h1" value="@if(isset($entry->seo)){{ $entry->seo->h1 }}@endif" id="h1" type="text" placeholder="Nome completo" class="form-control">
                </div>
              </div>
              <label class="col-md-2 control-label">TAG < <b>H2</b> ></label>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-rocket"></i>
                  </span>                                            
                  <input name="h2" value="@if(isset($entry->seo)){{ $entry->seo->h2 }}@endif" id="h2" type="text" placeholder="Nome completo" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">TAG < keywords ></label>
              <div class="col-md-10">

                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-check-square-o"></i>
                  </span>                                            
                  <input name="palavra_chave" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control tags" value="@if(isset($entry->seo)){{ $entry->seo->palavra_chave }}@endif" />
                </div>

              </div>
            </div>


            
          </div>    
        </div>
        

        <div class="form-group">
          <div class="col-md-12">
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-seo-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif  
          </div>
        </div>

      </form>
    </div>
  </div>
</div>