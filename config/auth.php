<?php
return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    
        'doctor' => [ 
            'driver' => 'session',
            'provider' => 'doctors', 
        ],

        'paciente' => [
            'driver' => 'session',
            'provider' => 'pacientes',
        ],

    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Doctor::class,
        ],

        'pacientes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Paciente::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'reset' => 'passwords',
            'expire' => 60,
        ],
    ],

    'passwords' => [
        'doctors' => [
            'provider' => 'doctors',
            'reset' => 'passwords',
            'expire' => 60,
        ],
    ],

];
