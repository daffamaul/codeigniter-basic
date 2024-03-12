<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about()
    {
        $data = [
            'title' => 'About Page',
            'content' => 'Content about page'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function faq()
    {
        return view('pages/faq');
    }
}
