<?php

namespace App\Http\Controllers;

use App\Models\User;
use Iliuminates\Database\Model;
use Iliuminates\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get()->toArray();
        foreach($users as $user){
            echo $user['email']."<br>";
        }
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
