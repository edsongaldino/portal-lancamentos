<?php

namespace App\Models;

use App\Models\User;
use Backpack\Base\app\Models\Traits\InheritsRelationsFromParentModel;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\CrudTrait;
use App\Models\Construtora;
use App\Models\UserPerfil;
use App\Models\ConstrutoraPerfil;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Potelo\GuPayment\GuPaymentTrait;

class BackpackUser extends User
{
    use InheritsRelationsFromParentModel, HasRoles, CrudTrait, SoftDeletes, GuPaymentTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'data_nascimento',
        'foto_perfil',
        'celular',
        'telefone_fixo',
        'whatsapp',
        'perfil_profissional',
        'foto'
    ];

    protected $hidden = [
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function acoesAposInserir($request, $id)
    {
        $usuario = $this->find($id);

        if ($request->construtora) {
            $this->atribuirConstrutora($request->construtora, $usuario);
            $this->criarRegistrosPerfis($usuario->id, $request->construtora);
        }

        $this->uploadLogoCortada($usuario, $request->foto);
    }

    public function criarRegistrosPerfis($usuario_id, $construtora_id)
    {
        (new UserPerfil())->gerar($usuario_id);
        (new ConstrutoraPerfil())->gerar($construtora_id);
    }

    public function atribuirConstrutora($construtora_id, $usuario)
    {
        $usuario->construtora_id = $construtora_id;
        $usuario->save();
    }

    public function uploadLogoCortada($usuario, $value)
    {
        $attribute_name = "foto";
        $disk = 'public';
        $destination_path = "/usuario/";

        if (starts_with($value, 'data:image')) {
            \Storage::disk($disk)->delete($this->{$attribute_name});

            $image = \Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            \Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $usuario->foto = '/uploads' . $destination_path . $filename;
            $usuario->save();
        }
    }

    public function salvarPerfil($request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->data_nascimento = $request->data_nascimento;
        $user->telefone_fixo = $request->telefone_fixo;
        $user->celular = $request->celular;
        $user->whatsapp = $request->whatsapp;
        $user->perfil_profissional = $request->perfil_profissional;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $foto = $this->uploadFoto($request, $id);

        if ($foto) {
            $user->foto = $foto;
            $user->save();
        }

        (new UserPerfil())->marcarPerfil($id, 'Informações Pessoais');

        return $user;
    }

    public function salvarPerfilDomus($request)
    {

        $user = User::find($request->id);
        $user->perfil_domus = $request->perfil_domus;
        $user->save();

        return $user;
    }

    public function uploadFoto($request, $id)
    {
        $campo = 'foto';
        if ($request->hasFile($campo)) {
            $request->validate([
                $campo => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            (new UserPerfil())->marcarPerfil($id, 'Foto');

            return '/uploads/' . $request->file($campo)->store('usuario');
        }
    }

    public function salvarDadosMembro($request, $construtora_id)
    {
        $usuario = new BackpackUser();

        if ($request->user_id) {
            $usuario = $this->find($request->user_id);
        }

        $usuario->name = $request->nome;
        $usuario->email = $request->email;
        $usuario->construtora_id = $construtora_id;

        if ($request->data_nascimento) {
            $usuario->data_nascimento = $request->data_nascimento;
        }

        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        if ($request->grupo) {
            $usuario->roles()->detach();
            foreach ($request->grupo as $grupo) {
                $usuario->roles()->attach($grupo);
            }
        }

        $this->criarRegistrosPerfis($usuario->id, $usuario->construtora_id);

        return true;
    }

    public function excluirMembro($id)
    {
        $this->find($id)->delete();

        return true;
    }

    public function cadastrarUsuarioAssinante($name, $email, $password)
    {
        $user = new BackpackUser();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    public function cadastrarAssinatura($construtora, $plano, $periodo)
    {
        $plano = "{$plano}_{$periodo}";
        $subscriptionBuilder = $this->newSubscription($plano, $plano);

        $options = [
            'name' => $this->name,
            'street' => $construtora->endereco->logradouro,
            'district' => $construtora->endereco->cidade->nome,
            'cpf_cnpj' => $construtora->cnpj,
            'zip_code' => $construtora->endereco->cep,
            'number' => $construtora->endereco->numero,
        ];

        $assinatura = $subscriptionBuilder->create(null, $options);

        $url = null;

        if ($assinatura && isset($assinatura['recent_invoices'])) {
            foreach ($assinatura->recent_invoices as $fatura) {
                $url = $fatura->secure_url;
            }
        }

        return $url;
    }

    public function getPerfil()
    {
        $perfil = null;
        $roles = $this->roles;

        if ($roles) {
            foreach ($this->roles as $role) {
                $perfil = $role->name;
            }
        }

        return $perfil;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function perfil()
    {
        return $this->hasMany('App\Models\UserPerfil');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getDataNascimentoAttribute($valor)
    {
        if ($valor && (new \DateTime($valor))) {
            return (new \DateTime($valor))->format('d/m/Y');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setDataNascimentoAttribute($valor)
    {
        if ($valor && (\DateTime::createFromFormat('d/m/Y', $valor))) {
            $this->attributes['data_nascimento'] = (\DateTime::createFromFormat('d/m/Y', $valor))->format('Y-m-d');
        }
    }
}
