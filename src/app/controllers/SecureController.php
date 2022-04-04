<?php

use Phalcon\Mvc\Controller;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Component;
use Phalcon\Acl\Role;


class SecureController extends Controller

{
    public function indexAction()
    {
        // $this->view->users = Users::find();
    }
    public function BuildAction()
    {
        $data = Permissions::find();

        // print_r(json_decode($data[1]->action));
        // die();

        $aclFile = APP_PATH . '/security/acl.cache';
        if (true !== is_file($aclFile)) {
            // acl does not exist build it
            $acl = new Memory();
            // print_r(json_encode($acl));


            // $acl->addRole('admin');
            // $acl->addRole('customer');
            // $acl->addRole('guest');

            foreach ($data as $k => $v) {
                $acl->addRole($v->role);
                $acl->addComponent($v->controller, json_decode($v->action));
                $acl->allow($v->role, $v->controller, json_decode($v->action));
            }

            // $acl->addComponent(
            //     'test',
            //     [
            //         'eventtest'
            //     ]
            // );

            // $acl->allow('admin', '*', '*');

            // $acl->allow('guest', 'product', 'addproduct');

            file_put_contents(
                $aclFile,
                serialize($acl)
            );
        } else {
            $acl = unserialize(
                file_get_contents($aclFile)
            );
        }

        // if (true == $acl->isAllowed('admin', '*', '*')) {
        //     echo "Access Granted";
        // } else {
        //     echo "Access Denied";
        // }
    }

    public function roleAction()
    {
    }

    public function addroleAction()
    {
        $roles = new Roles();
        $roles->assign(
            $this->request->getPost(),
            [

                'role'
            ]
        );
        $roles->save();
        $this->response->redirect('/secure');
    }

    public function componentAction()
    {
    }

    public function addcomponentAction()
    {
        $component = new Components();
        $component->assign(
            $this->request->getPost(),
            [

                'controller'
            ]
        );
        // print_r(json_encode($component));
        // die;
        $component->save();
        $this->response->redirect('/secure');
    }

    public function actionAction()
    {
        $this->view->component = Components::find();
    }

    public function addactionAction()
    {
        $action = new Action();
        $action->assign(
            $this->request->getPost(),
            [

                'action',
                'controller_id'
            ]
        );
        // print_r((json_encode($action)));
        // die;
        $action->save();
        $this->response->redirect('/secure');
    }

    public function permissionAction()
    {
        $this->view->role = Roles::find();
        $this->view->controller = Components::find();
        // $this->view->action = Action::find();
    }

    public function addpermissionAction()
    {
        $data = $this->request->getPost();

        $count = count($_POST);
        $action = array_slice($_POST, 2, $count - 3);

        $actions = array();
        foreach ($action as $k => $v) {
            array_push($actions, $v);
        }
        $fill = new Permissions();
        $actions = json_encode($actions);
        $value = array(
            'role' => $data['roles'],
            'controller' => $data['controller'],
            'action' => $actions
        );
        $fill->assign(
            $value,
            [
                'role',
                'controller',
                'action'
            ]
        );
        $fill->save();
        $this->response->redirect('/secure/permission');
    }
}
