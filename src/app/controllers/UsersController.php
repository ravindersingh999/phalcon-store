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

    public function userlistAction()
    {
        $this->view->user = Users::find();
    }

    public function deleteAction()
    {
        $bearer = $this->request->get('bearer');
        $id = $this->request->getPost('id');
        $user = Users::findFirst(
            [
                "id = '$id'"
            ]
        );
        // print_r(json_encode($user));
        // die;
        $user->delete();
        $this->response->redirect('/users/userlist?bearer=' . $bearer);
    }

    public function edituserAction()
    {
        $id = $this->request->getPost('id');
        $this->view->user = Users::findFirst(
            [
                "id = '$id'"
            ]
        );
    }

    public function editAction()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        $users = Users::findFirst(
            [
                "id = '$id'"
            ]
        );

        $users->name = $name;
        $users->email = $email;
        $users->role = $role;
        $users->save();

        $this->response->redirect('/users/userlist?bearer='.$this->request->get('bearer'));
    }
}
