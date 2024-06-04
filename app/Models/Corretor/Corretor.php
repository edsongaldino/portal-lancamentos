<?php

namespace App\Models\Corretor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Corretor extends Authenticatable
{
    use Notifiable;
    protected $table = 'corretor';
}