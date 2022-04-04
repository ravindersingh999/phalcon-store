<?php

use Phalcon\Mvc\Controller;
use Firebase\JWT\JWT;

class UsersController extends Controller
{
    public function indexAction()
    {
        $this->view->role = Roles::find();

        $bearer = $this->request->get('bearer');
        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "role" => $_POST['role']
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        $user = new Users();
        $data = $this->request->getPost();
        $myescaper = new \App\Components\myescaper();
        $santitizedata = $myescaper->sanitize($data);
        $user->assign(
            $santitizedata,
            [
                'name',
                'email',
                'password',
                'role'
            ]
        );
        $user->token = $jwt;
        $user->save();
        // $this->response->redirect('/users/index?bearer='.$bearer);
    }
}
