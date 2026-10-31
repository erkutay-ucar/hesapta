<?php

function rol_adi($rol)
{
    $roller = [
        'manager'        => 'Restoran Yöneticisi',
        'waiter'         => 'Garson',
        'kitchen'        => 'Mutfak',
    ];

    return $roller[$rol] ?? $rol;
}

function ana_sayfa_adresi($rol)
{
    $adresler = [
        'manager'        => 'yonetim',
        'waiter'         => 'masalar',
        'kitchen'        => 'mutfak',
    ];

    return $adresler[$rol] ?? '/';
}
