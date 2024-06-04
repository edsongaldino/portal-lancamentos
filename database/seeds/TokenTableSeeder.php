<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\User;

class TokenTableSeeder extends Seeder
{
    public function run()
    {
        $token = Str::random(60);
        
        User::find(2)->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        echo "TOKEN -> {$token}" . "\n";
    }
}
