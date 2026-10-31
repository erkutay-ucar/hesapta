<?php

function rol_adi($rol)
{
    $roller = [
        'platform_admin' => 'Platform Yöneticisi',
        'manager'        => 'Restoran Yöneticisi',
        'waiter'         => 'Garson',
        'kitchen'        => 'Mutfak',
    ];

    return $roller[$rol] ?? $rol;
}

function ana_sayfa_adresi($rol)
{
    $adresler = [
        'platform_admin' => 'admin/panel',
        'manager'        => 'yonetim',
        'waiter'         => 'masalar',
        'kitchen'        => 'mutfak',
    ];

    return $adresler[$rol] ?? '/';
}
