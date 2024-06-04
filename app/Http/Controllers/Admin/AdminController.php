<?php

namespace app\Http\Controllers\Admin;

use Backpack\Base\app\Http\Controllers\AdminController as AdminControllerBase;

class AdminController extends AdminControllerBase
{
    private $view;

    public function __construct() {
        parent::__construct();
        $this->view = isMobile() ? 'admin.estatisticas.desktop.index' : 'admin.estatisticas.desktop.index';
    }

    public function dashboard()
    {    
        $this->data['construtora_id'] = \Auth::user()->construtora_id;

        return view($this->view, $this->data);
    }
}
