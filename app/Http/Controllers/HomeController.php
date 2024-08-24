<?php

namespace App\Http\Controllers;

use Iliuminates\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $random = random_bytes(4);
        // $bin = bin2hex($random);
        // echo $bin;
        exit;
        $validation = $this->validate([
            'user_id' => $_GET['user_id'] ?? '',
        ], [
            'user_id' => ['required', 'integer'],
        ], [
            'user_id' => trans('main.user_id'),
        ]);
        echo "<pre>";
        return var_dump($validation->failed());
        // $title = 'title';
        // $content = 'content data';
        // return view('index', compact('title','content'));
    }

    public function data()
    {
        return view('data');
    }

    public function data_post()
    {
        echo "<pre>";
        return var_dump(request());

        // $file = request()->file('file');
        // $file->name(time());
        // return $file->store('my/images');

        //return Request::file('file')->store('data');
        //return Request::file('file');
    }

    public function about()
    {
        echo 'Welcome To About page';
    }

    public function article($id)
    {
        echo 'Welcome To article page id = ' . $id;
    }

    public function api_any()
    {
        echo 'Welcome To api_any page ';
    }
}
