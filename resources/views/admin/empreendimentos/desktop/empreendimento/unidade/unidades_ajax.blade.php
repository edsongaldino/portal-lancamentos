<label for="">Selecione as unidades que deseja alterar:</label>
<div class="input-group btn-group">
    <span class="input-group-addon">
        <i class="fa fa-sort-numeric-desc"></i>
    </span>    
    <select class="form-control unidades_multiplas" placeholder="Selecione" name="unidade_alteracao[]" multiple data-plugin-selectTwo>
        <option value="" disabled hidden>Selecione as unidades</option>
        @foreach($unidades as $unidade)
        <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
        @endforeach
    </select>      
</div>

<script type="text/javascript">
	$(function () {
		$('.unidades_multiplas').select2();
	});
</script>