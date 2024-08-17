<?php
namespace App\Http\Controllers;

use Iliuminates\Http\Validations\Validation;

class HomeController extends Controller
{
    public function index()
    {

        
        $validation = Validation::make([
             'user_id'=>$_GET['user_id']??'',
        ], [
             'user_id'=>['required','integer','exists:users,id'],
        ], [
             'user_id'=>trans('main.user_id'),
        ]);
        return $validation;
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
