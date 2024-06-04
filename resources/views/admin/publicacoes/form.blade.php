@csrf 
<div class="form-group">
    <label class="col-md-1 control-label" for="textareaDefault">Título</label>
    <div class="col-md-8">
        <input class="form-control" data-plugin-maxlength maxlength="100" name="titulo" value="{{ $publicacao->titulo ?? '' }}" required/>
        <p>
            <code>Máximo de</code> 100 caracteres.
        </p>
    </div>
    <label class="col-md-1 control-label" for="textareaDefault">Data</label>
    <div class="col-md-2">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input id="date" name="data" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" value="{{ $publicacao->data ?? '' }}" class="form-control" required>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-1 control-label" for="textareaDefault">Resumo</label>
    <div class="col-md-7">
        <textarea class="form-control textarea" rows="3" data-plugin-maxlength maxlength="250" name="resumo" required>{{ $publicacao->resumo ?? '' }}</textarea>
        <p>
            <code>Máximo de</code> 250 caracteres.
        </p>
    </div>

    <label class="col-md-1 control-label" for="textareaDefault">Fonte</label>
    <div class="col-md-3">
        <input class="form-control" data-plugin-maxlength maxlength="100" name="fonte" value="{{ $publicacao->fonte ?? '' }}" required/>
        <p>
            <code>Máximo de</code> 100 caracteres.
        </p>
    </div>

    <label class="col-md-1 control-label status" for="textareaDefault">Status</label>
    <div class="col-md-3">
        <select data-plugin-selectTwo class="form-control populate status" name="status" required>
            <option value="Liberada" @if(($publicacao->status ?? '') == 'Liberada') selected @endif>Liberada</option>
            <option value="Bloqueda" @if(($publicacao->status ?? '') == 'Bloqueda') selected @endif>Bloqueda</option>
        </select>
    </div>

</div>

<div class="form-group"> 
    <div class="col-md-1 control-label">Imagem</div>
    @if($publicacao->arquivo ?? '')
    <div class="col-md-2"><img src="/uploads/{{ $publicacao->arquivo ?? '' }}" width="100%" class="img-responsive" alt=""></div>
    @endif
    <div class="col-md-9">
        <input type="file" name="arquivo" id="arquivo" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-1 control-label">Texto Completo</label>
    <div class="col-md-11">
        <textarea name="texto" data-plugin-markdown-editor rows="10" required>{{ $publicacao->texto ?? '' }}</textarea>
    </div>
</div>

<script src="/assets/javascripts/publicacoes/index.js"></script>