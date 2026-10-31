<?php

namespace App\Controllers;

class Yonetim extends BaseController
{
    public function index()
    {
        return view('yonetim/index', ['baslik' => 'Ana Sayfa']);
    }
}
