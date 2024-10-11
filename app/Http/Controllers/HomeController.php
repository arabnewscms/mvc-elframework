<?php

namespace App\Http\Controllers;

use App\Models\User;
use Iliuminates\Database\Model;
use Iliuminates\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::paginate(1);
        
       
        //  echo "getTotal: ".$paginate->getTotal()."<br>";
        //  echo "getPerPage: ".$paginate->getPerPage()."<br>";
        //  echo "getCurrentPage: ". $paginate->getCurrentPage()."<br>";
        //  echo "<br> hasNextPage:";
        //  echo $paginate->hasNextPage()?"yes":"no";
        //  echo "<br> hasPreviousPage:";
        //  echo  $paginate->hasPreviousPage()?"yes":"no";
        // exit;n User::where('name','LIKE','%p%')->count();
        // $users = User::take(3)->get()->toArray();
        // foreach ($users as $user) {
        //     echo $user['email']."<br>";
        // }

        return view('index',['users'=>$users]);
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
