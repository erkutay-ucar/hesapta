<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GirisFiltresi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session('rol')) {
            return redirect()->to('/')->with('hata', 'Bu sayfayı görmek için giriş yapmalısınız.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
