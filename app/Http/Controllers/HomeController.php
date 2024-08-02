<?php 
namespace App\Http\Controllers;

 
class HomeController 
{
    public function index()
    {
        $title = 'title';
        $content = 'content data';
        return view('index', compact('title','content'));
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