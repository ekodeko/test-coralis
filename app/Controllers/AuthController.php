<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthController extends BaseController
{
    public function login()
    {
        return view('templates/header')
            . view('pages/auth/login')
            . view('templates/footer');
    }

    function doLogin()
    {
        helper(['form']);

        if (session()->has('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {

                session()->set('isLoggedIn', true);
                session()->set('userData', $user);
                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('errors', 'Email or password wrong');
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function register()
    {
        return view('templates/header')
            . view('pages/auth/register')
            . view('templates/footer');
    }

    function doRegister()
    {
        helper(['form']);

        if (session()->has('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $rules = [
            'fullname' => 'required|min_length[3]',
            'password' => 'required|min_length[8]',
            'email' => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $userModel = new UserModel();
            $userModel->save([
                'fullname' => $this->request->getPost('fullname'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'email' => $this->request->getPost('email'),
            ]);

            return redirect()->to('/login')->with('success', 'Registration Successful');
        }
    }

    function logout()
    {
        session()->remove('isLoggedIn');
        session()->remove('userData');

        return redirect()->to('/login');
    }

    public function forgotPassword()
    {
        return view('templates/header')
            . view('pages/auth/forgot_password')
            . view('templates/footer');
    }

    public function processForgotPassword()
    {
        helper(['form']);

        $user_email = $this->request->getPost('email');

        $userModel = new UserModel();
        $user = $userModel->where('email', $user_email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(16));
            $userModel->update($user['id'], ['reset_token' => $token]);

            // send email
            $email = Services::email();

            $email->setTo($user_email);
            $email->setSubject('Reset Password');
            $link = '<a href="'.base_url("/reset_password/$token").'">Reset Password</a>';
            $email->setMessage('Silakan klik link berikut untuk mereset password Anda: ' . $link);
            if ($email->send()) {
                log_message('info', 'email send to ' . $user_email);
            } else {
                log_message('alert', $email->printDebugger(['headers']));
            }
        }

        return redirect()->to('/login')->with('errors', 'Email reset password telah dikirim.');
    }

    public function resetPassword($token)
    {
        return view('templates/header')
            . view('pages/auth/reset_password', ['token' => $token])
            . view('templates/footer');
    }

    public function processResetPassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if ($user) {
            $userModel->update($user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT), 'reset_token' => null]);

            return redirect()->to('/login')->with('success', 'Password Anda telah direset.');
        } else {
            return redirect()->to("/reset_password/$token")->with('error', 'Token reset password tidak valid.');
        }
    }


    function dd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}
