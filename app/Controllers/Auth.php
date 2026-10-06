<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function authenticate()
    {
        $model = new UserModel();

        $user = $model->where(
            'username',
            $this->request->getPost('username')
        )->first();

        if (
            $user &&
            $this->request->getPost('password') === $user['password']
        ) {
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => true
            ]);

            return redirect()->to('/customers');
        }

        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}