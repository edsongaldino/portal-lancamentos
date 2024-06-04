<div class="panel panel-accordion panel-accordion-primary">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Five">
        <i class="fa fa-share-alt"></i> Redes Sociais
      </a>
    </h4>
  </div>
  <div id="collapse2Five" class="accordion-body collapse">
    <div class="panel-body">
      <form id="dados-redes-sociais">
        <div class="form-group">
          <label class="col-md-1 control-label"><i class="fa fa-facebook fa-2x"></i></label>
          <div class="col-md-11">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-hand-o-right"></i>
              </span>
              <input name="facebook" value="@if ($construtora){{ $construtora->facebook }}@endif" type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-1 control-label"><i class="fa fa-twitter fa-2x"></i></label>
          <div class="col-md-11">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-hand-o-right"></i>
              </span>
              <input name="twitter" value="@if($construtora){{ $construtora->twitter }}@endif" type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-1 control-label"><i class="fa fa-instagram fa-2x"></i></label>
          <div class="col-md-11">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-hand-o-right"></i>
              </span>
              <input name="instagram" value="@if($construtora){{ $construtora->instagram }}@endif" type="text" class="form-control">
            </div>
          </div>
        </div> 

        <div class="form-group">
          <label class="col-md-1 control-label"><i class="fa fa-youtube fa-2x"></i></label>
          <div class="col-md-11">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-hand-o-right"></i>
              </span>
              <input name="youtube" value="@if($construtora){{ $construtora->youtube }}@endif" type="text" class="form-control">
            </div>
          </div>
        </div> 

        <div class="form-group">
          <div class="col-md-12">
            <button class="btn btn-success" type="button" id="salvar-dados-redes-sociais">Salvar dados</button>    
          </div>
        </div>
      </form>                       
    </div>
  </div>
</div>