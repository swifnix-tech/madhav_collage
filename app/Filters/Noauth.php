<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

			if (session()->get('role') == ADMIN_ROLE) {
				return redirect()->to(base_url('admin'));
			}

			elseif (session()->get('role') == ACCOUNTANT_ROLE) {
				return redirect()->to(base_url('accountant'));
			}
            else{
                return redirect()->to(base_url("student"));
            }


        }
       
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}