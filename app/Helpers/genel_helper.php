<?php

function rol_adi($rol)
{
    $roller = [
        'platform_admin' => 'Platform Yöneticisi',
        'manager'        => 'Restoran Yöneticisi',
        'waiter'         => 'Garson',
        'kitchen'        => 'Mutfak Personeli',
    ];

    return $roller[$rol] ?? $rol;
}
