<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RolFiltresi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $izinliRoller = $arguments ?? [];

        if (! in_array(session('rol'), $izinliRoller, true)) {
            return redirect()->to(ana_sayfa_adresi(session('rol')))->with('hata', 'Bu sayfaya erişim yetkiniz yok.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
