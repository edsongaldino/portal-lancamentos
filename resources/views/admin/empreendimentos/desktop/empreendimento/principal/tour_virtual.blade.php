<div class="panel panel-accordion panel-accordion-info">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a style="background-color: #192d2d" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse22Midia">
        <i class="fa fa-circle-o-notch" aria-hidden="true"></i> Tour Virtual 360º
      </a>
    </h4>
  </div>
  <div id="collapse22Midia" class="accordion-body collapse">
    <div class="panel-body">
      <form id="tour-empreendimento" class="form-horizontal form-bordered form-tour">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif
        
        @if(isset($itens_tour))
          @if($itens_tour->count() > 0)
          @php $i = 0; @endphp
          @foreach ($itens_tour as $tour)
          @php $i++;@endphp
          <div class="form-group">

            <label for="Link - Tour Virtual" class="col-md-1 control-label">Link</label>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-circle-o-notch"></i>
                </span>
                <input class="form-control" type="text" name="link_tour[]" value="{{ $tour->link }}">
              </div>
            </div>
            
            <label for="Link - Tour Virtual" class="col-md-1 control-label">Título</label>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-edit"></i>
                </span>
                <input class="form-control" type="text" name="titulo_tour[]" maxlength="20" placeholder="TOUR ÁREA DE LAZER" value="{{ $tour->titulo }}">
              </div>
            </div>
            @if ($i == 1)
            <button class="col-md-1 btn btn-success copy-tour" id="addTour" type="button"><i class="fa fa-plus"></i></button>
            @else
            <button class="btn btn-danger removeTour col-md-1" type="button"><i class="fa fa-minus"></i></button>
            @endif
          </div>
          @endforeach
          @else

          <div class="form-group">

            <label for="Link - Tour Virtual" class="col-md-1 control-label">Link</label>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-circle-o-notch"></i>
                </span>
                <input class="form-control" type="text" name="link_tour[]" value="">
              </div>
            </div>
            
            <label for="Link - Tour Virtual" class="col-md-1 control-label">Título</label>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-edit"></i>
                </span>
                <input class="form-control" type="text" name="titulo_tour[]" maxlength="20" placeholder="TOUR ÁREA DE LAZER" value="">
              </div>
            </div>

            <button class="col-md-1 btn btn-success copy-tour" id="addTour" type="button"><i class="fa fa-plus"></i></button>
          </div>

        @endif
        @endif

        
        <div class="tour" style="display: none;">

          <div class="form-group linha-tour">

            <label for="Link - Tour Virtual" class="col-md-1 control-label">Link</label>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-circle-o-notch"></i>
                </span>
                <input class="form-control" type="text" name="link_tour[]">
              </div>
            </div>
            
            <label for="Link - Tour Virtual" class="col-md-1 control-label">Título</label>
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-edit"></i>
                </span>
                <input class="form-control" type="text" name="titulo_tour[]" maxlength="20" placeholder="TOUR ÁREA DE LAZER">
              </div>
            </div>

            <button class="btn btn-danger removeTour col-md-1" type="button"><i class="fa fa-minus"></i></button>

          </div>

        </div>
        

        <div id="tour360">

        </div>

        <div class="form-group">
          <div class="col-md-12">
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-tour" type="button" id="salvar-tour-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-tour erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif   
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>