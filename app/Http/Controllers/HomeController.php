<?php
namespace App\Http\Controllers;

 

class HomeController extends Controller
{
    public function index()
    {
        $validation = $this->validate([
             'user_id'=>$_GET['user_id']??'',
        ], [
             'user_id'=>['required','integer'],
        ], [
             'user_id'=>trans('main.user_id'),
        ]);
        echo "<pre>";
        return var_dump($validation->failed());
        // $title = 'title';
        // $content = 'content data';
        // return view('index', compact('title','content'));
    }

    public function about()
    {
        echo 'Welcome To About page';
    }

    public function article($id)
    {
        echo 'Welcome To article page id = '.$id;
    }

    public function api_any()
    {
        echo 'Welcome To api_any page ';
    }


}
