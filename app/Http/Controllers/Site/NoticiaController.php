<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publicacao;

class NoticiaController extends Controller
{
	private $view;

    public function __construct()
    {
        $this->view = isMobile() ? 'site.noticia.mobile.index' : 'site.noticia.desktop.index';
    }

    public function index($id, $titulo)
    {
        $this->data['noticia'] = Publicacao::find($id);
        $this->data['ultimas_noticias'] = Publicacao::where('id', '<>', $id)->orderBy('data', 'DESC')->take(3)->get();

        return view($this->view, $this->data);
    }
}
