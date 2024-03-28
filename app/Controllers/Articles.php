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
            'articles' => $this->articles->getArticles(),
        ];

        return view('articles/index', $data);
    }

    public function detail($slug)
    {
        $data['slug'] = $this->articles->getArticles($slug);

        if (!$data['slug']) {
            // This exception does not working
            throw new PageNotFoundException('Article doesn\'t exist.');
        }

        $data['title'] = $data['slug']['title'];

        return view('articles/detail', $data);
    }

    public function admin_index()
    {
        $qSearch = $this->request->getGet('q') ?? '';

        $data = [
            'title' => 'Admin Page',
            'q' => $qSearch,
            'articles' => $this->articles->like('title', $qSearch)->paginate(1),
            'pager' => $this->articles->pager
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
