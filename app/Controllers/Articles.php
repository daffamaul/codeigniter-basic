<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
    protected $articles;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->articles = new ArticlesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Articles',
            'articles' => $this->articles->findAll(),
        ];

        return view('articles/index', $data);
    }

    public function detail($slug)
    {
        if (!$slug) {
            // This exception does not working
            throw PageNotFoundException::forPageNotFound('Article doesn\'t exist.');
        }

        $data = [
            'slug' => $this->articles->where('slug', $slug)->first(),
            'title' => $this->articles->where('slug', $slug)->first()['title']
        ];

        return view('articles/detail', $data);
    }

    public function admin_index()
    {
        $data = [
            'title' => 'Admin Page',
            'articles' => $this->articles->findAll()
        ];

        return view('articles/admin', $data);
    }

    public function add()
    {
        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $validateData = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($validateData, $rules)) {
            $data['title'] = 'Adding Article';
            return view('articles/form_add', $data);
        }

        $validData = $this->validator->getValidated();

        $data_db = [
            'title' => $validData['title'],
            'content' => $validData['content'],
            'slug' => url_title(strtolower($validData['title']))
        ];

        $this->articles->insert($data_db);

        return $this->admin_index();
    }

    public function edit($id)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $validateData = $this->request->getPost(array_keys($rules));

        $this->validateData($validateData, $rules);

        $validData = $this->validator->getValidated();

        if (!$validData) {
            $data = [
                'title' => 'Editing Article',
                'article' => $this->articles->where('id', $id)->first(),
                'error' => $validData
            ];

            return view('articles/form_edit', $data);
        }

        $data_db = [
            'id' => $id,
            'title' => $validData['title'],
            'content' => $validData['content'],
            'slug' => url_title(strtolower($validData['title']))
        ];

        $this->articles->replace($data_db);

        return $this->admin_index();
    }

    public function delete($id)
    {
        $this->articles->delete($id);
        return $this->admin_index();
    }
}
