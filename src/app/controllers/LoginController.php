<?php

use Phalcon\Mvc\Controller;


class LoginController extends Controller
{
    public function indexAction()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($this->request->getPost()) {
            if (empty($email) || empty($password)) {
                $this->view->loginmsg = "Fill all details!";
            } else {
                $user = Users::findFirst(array(
                    'email = :email: and password = :password:', 'bind' => array(
                        'email' => $email,
                        'password' => $password
                    )
                ));

                if (!$user) {
                    $this->view->loginmsg = "Wrong Credentials!";
                } else {
                    $bearer = $this->request->get('bearer');
                    $this->response->redirect('admin/index?bearer='.$bearer);
                    $this->session->set('user', $email);
                }
            }
        }
    }
}
