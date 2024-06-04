<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpreendimentoArquivos extends Model
{
    protected $table = 'empreendimentos_arquivos';
    protected $fillable = ['tipo', 'arquivo'];

    public function salvarArquivosEmpreendimento($request, $id)
    {

        $nameFile = null;

        if ($request->hasFile('memorial_descritivo') && $request->file('memorial_descritivo')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = 'memorialDescritivo_'.$id;

            // Recupera a extensão do arquivo
            $extension = $request->memorial_descritivo->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $request->memorial_descritivo->storeAs('arquivos', $nameFile);

        }

        if ($nameFile) {

            $arquivo = new EmpreendimentoArquivos();
            $arquivo->empreendimento_id = $id;
            $arquivo->tipo = 'Memorial Descritivo';
            $arquivo->arquivo = $nameFile;
            $arquivo->save();

        }

        return $arquivo;


    }

    public function salvarVideosEmpreendimento($request, $id)
    {

        $nameFile = null;

        if ($request->hasFile('memorial_descritivo') && $request->file('memorial_descritivo')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = 'memorialDescritivo_'.$id;

            // Recupera a extensão do arquivo
            $extension = $request->memorial_descritivo->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $request->memorial_descritivo->storeAs('arquivos', $nameFile);

        }

        if ($nameFile) {

            $arquivo = new EmpreendimentoArquivos();
            $arquivo->empreendimento_id = $id;
            $arquivo->tipo = 'Memorial Descritivo';
            $arquivo->arquivo = $nameFile;
            $arquivo->save();

        }

        return $arquivo;


    }
}
