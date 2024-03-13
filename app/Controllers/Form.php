<?php

namespace App\Controllers;

class Form extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        if (!$this->request->is('post')) {
            return view('signup');
        }

        $rules = [
            // @TODO
            'username' => 'required|max_length[30]',
            'password' => 'required|max_length[255]|min_length[10]',
            'passconf' => 'required|max_length[255]|matches[password]',
            'email'    => 'required|max_length[254]|valid_email',
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return view('signup');
        }

        // If you want to get the validated data.
        $validData = $this->validator->getValidated();
        
        return view('success');
    }
}
