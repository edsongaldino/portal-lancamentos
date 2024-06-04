<?php

use Illuminate\Database\Seeder;
use App\Models\BackpackUser;
use App\Models\Role;
use App\Models\Construtora;
use App\Models\Modalidade;
use App\Models\Caracteristica;
use App\Models\Tipoconstrutora;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = BackpackUser::where('email', 'admin@gmail.com')->get()->first();

        if ($user) {
            $user->password = bcrypt('roc3t5nk');
            $user->status = 'Ativo';
            $user->save();
        }
        
        if (!$user) {

            $user = new BackpackUser();
            $user->name = 'Admin';
            $user->email = 'admin@gmail.com';
            $user->password = bcrypt('roc3t5nk');
            $user->status = 'Ativo';
            $user->save();

            $role = Role::where('name', 'Administrador')->get();

            if (!$role->toArray()) {
                $role = new Role();
                $role->name = 'Administrador';
                $role->save();
                $role_id = $role->id;
            } else {
                $role_id = $role->first()->id;
            }

            $user->roles()->attach($role_id);

            $tipo = new Tipoconstrutora();
            $tipo->nome = "Construtora";
            $tipo->save();

            $modalidade = new Modalidade();
            $modalidade->nome = "Vertical";
            $modalidade->tipo = "Vertical";
            $modalidade->save();

            $construtora = new Construtora();
            $construtora->nome = "Construtora teste";
            $construtora->cnpj = "70.779.698/0001-70";
            $construtora->save();

            $construtora->modalidades()->sync($modalidade->id);
            $construtora->tipoconstrutora()->sync($tipo->id);

            $user = new BackpackUser();
            $user->name = 'Edson';
            $user->email = 'edson@gmail.com';
            $user->password = bcrypt('roc3t5nk');
            $user->status = 'Ativo';
            $user->construtora_id = $construtora->id;
            $user->save();

            $role = Role::where('name', 'Diretor')->get();

            if (!$role->toArray()) {
                $role = new Role();
                $role->name = 'Diretor';
                $role->save();
                $role_id = $role->id;
            } else {
                $role_id = $role->first()->id;
            }

            $user->roles()->attach($role_id);
        }

        $this->caracteristicasBasicas();
    }

    public function caracteristicasBasicas()
    {
        $caracteristicas = [
            'Unidades No Térreo?' => 'Torre',
            'Andares' => 'Torre',
            'Cobertura' => 'Torre',
            'Unidades Por Andar' => 'Torre',
            'Elevador Social' => 'Torre',
            'Elevador De Serviço' => 'Torre',
            'Nomenclatura Das Unidades' => 'Torre',

            'Quarto' => 'Planta',
            'Suíte' => 'Planta',
            'Banheiro' => 'Planta',
            'Metragem' => 'Planta',
            'Tipo de Planta' => 'Planta'
        ];

        foreach ($caracteristicas as $nome => $tipo) {
            
            $existe = Caracteristica::where('nome', $nome)->where('tipo', $tipo)->get()->first();

            $c = new Caracteristica();

            if ($existe) {
                $c = $existe;
            }
            
            $c->nome = $nome;
            $c->tipo = $tipo;
            $c->save();
        }
    }
}
