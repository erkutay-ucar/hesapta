<?php

namespace App\Controllers;

class Masalar extends BaseController
{
    public function index()
    {
        return view('masalar/index', ['baslik' => 'Masalar']);
    }
}
