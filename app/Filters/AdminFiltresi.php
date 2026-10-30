<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFiltresi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('rol') !== 'platform_admin') {
            return redirect()->to('admin')->with('hata', 'Bu sayfayı görmek için giriş yapmalısınız.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
