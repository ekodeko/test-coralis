<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = session('userData');
        $userModel = new UserModel();
        $user = $userModel->where('id', $data['id'])->first();
        return view('templates/header')
            . view('pages/dashboard/profile',[
                'data'  => $user
            ])
            . view('templates/footer');
    }

    function update_profile_picture() {
        helper(['form']);
        // print_r($this->request->getPost());
        $rules = [
            'profile_picture' => 'uploaded[profile_picture]|max_size[profile_picture,1024]|is_image[profile_picture]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        
        $file = $this->request->getFile('profile_picture');
        $newName = $file->getRandomName();
        $file->move('images', $newName);
        
        $userModel = new UserModel();
        $userId = $this->request->getPost('id');
        $data_to_update =  ['profile_picture' => $newName];
        // print_r($user);
        // die;
        $userModel->update($userId, $data_to_update);

        return redirect()->to('/')->with('success', 'Foto profile berhasil di perbarui.');
    }
}
