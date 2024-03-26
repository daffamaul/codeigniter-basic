<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
// use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $users;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'users' => $this->users->getUsers()
        ];

        return view('users/index', $data);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');

        if (!$email) {
            return view('users/login');
        }

        $users = $this->users->getUsers($email);

        if ($users) {
            $passwordHash = $users['userpassword'];

            if (password_verify("$pass", $passwordHash)) {
                $login = [
                    'user_id' => $users['id'],
                    'user_name' => $users['username'],
                    'user_email' => $users['useremail'],
                    'logged_in' => true
                ];

                session()->set($login);

                return redirect('admin/articles');
            } else {
                session()->setFlashdata('fail', 'Password salah.');
                return redirect()->to('users/login');
            }
        } else {
            session()->setFlashdata('fail', 'Pengguna tidak terdaftar');
            return redirect()->to('users/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return view('users/login');
    }
}
