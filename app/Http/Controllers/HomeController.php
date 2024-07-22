<?php 
namespace App\Http\Controllers;

class HomeController 
{
    public function index()
    {
        return 'Welcome To Index page';
    }

    public function about()
    {
        echo 'Welcome To About page';
    }

    public function article($id)
    {
        echo 'Welcome To article page id = '.$id;
    }

    
}