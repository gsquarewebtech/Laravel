<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Artisan::command('user:create', function () {
    $name = $this->ask('First Name?');
    $lastname = $this->ask('Last Name ?');
    $email = $this->ask('Email?');
    $pwd = $this->secret('Password?');

    User::query()
        ->create([
            'first_name' => $name,
            'last_name' => $lastname,
            'user_type' => 'super_admin',
            'email' => $email,
            'password' => Hash::make($pwd),
        ]);

    $this->info('Account created for '.$name);
});